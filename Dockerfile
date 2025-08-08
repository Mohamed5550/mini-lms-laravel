FROM php:8.3 AS php

RUN apt-get update -y
RUN apt-get install -y unzip libpq-dev libcurl4-gnutls-dev libonig-dev libxml2-dev libzip-dev
RUN docker-php-ext-install bcmath curl mbstring mysqli pdo pdo_mysql xml zip

RUN pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis

COPY --from=composer:2.8.10 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . .

ENV PORT=8000

ENTRYPOINT [ "docker/entrypoint.sh" ]

# =========================
# node
FROM node:22-alpine AS node 

WORKDIR /var/www
COPY . .

RUN npm install --global cross-env
RUN npm install

VOLUME /var/www/node_modules