#!/bin/bash

if [ ! -f "vendor/autoload.php" ]; then
    composer install --no-progress --no-interaction
fi

if [ ! -f ".env" ]; then
    echo "Creating .env file for env $APP_ENV"
    cp .env.example .env
else 
    echo ".env file exists"
fi

role=${CONTAINER_ROLE:-app}
if [ "$role" = "app" ]; then
    php artisan key:generate
    php artisan storage:link
    
    # Check if migrations table exists and has entries
    if ! php artisan tinker --execute="echo \DB::table('migrations')->count();" 2>/dev/null | grep -q '^[1-9]'; then
        echo "Running fresh migrations with seed..."
        php artisan migrate --seed
    else
        echo "Running migrations (no seed)..."
        php artisan migrate
    fi

    php artisan optimize:clear

    php artisan serve --port=$PORT --host=0.0.0.0
    exec docker-php-entrypoint "$@"
elif [ "$role" == "queue" ]; then
    echo "Running the queue ..."
    php /var/www/artisan queue:work --verbose --tries=3 --timeout=3600
elif [ "$role" == "websocket" ]; then
    echo "Running the websocket ..."
    php /var/www/artisan websockets:serve
fi