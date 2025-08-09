# Mini LMS Laravel

A mini Learning Management System built with **Laravel** and **Docker**, featuring seeded sample data for quick testing.  
Includes API endpoints for courses, sessions, and authentication with Laravel Sanctum.

---

## 📦 Features

- Laravel 12 (PHP 8.3)
- Sanctum authentication with API tokens
- Role-based access control (Student / Teacher)
- Courses and sessions management
- Feature tests for course creation
- Dockerized setup for development
- Automatic database seeding on first run
- Postman collection included

---

## 🚀 Getting Started

### 1. Clone the Repository

```bash
git clone https://github.com/Mohamed5550/mini-lms-laravel
cd mini-lms-laravel
```

### 2. Start the Application with Docker

```bash
docker-compose up --build
```

This will:

- Install dependencies
- Create .env file (if missing)
- Run migrations
- Seed the database only on the first run
- Start the Laravel development server at http://localhost:8000

## ⚙️ Environment Variables

The .env file will be auto-created from .env.example during first startup.
You can manually adjust variables such as:

```ini
APP_ENV=local
APP_DEBUG=true
APP_KEY=

DB_CONNECTION=mysql
DB_HOST=database
DB_PORT=3306
DB_DATABASE=minimal_lms
DB_USERNAME=minimal_lms
DB_PASSWORD=root
```

## 🗄️ Seeded Credentials

```text
admin@test.com
password

teacher@test.com
password
```

I've also seeded few courses and sessions with the teacher

## 🧪 Testing

```bash
docker-compose exec php php artisan test
```

## 📝 Postman Collection

You can find an exportable Postman collection in:

[https://lively-eclipse-415471.postman.co/workspace/New-Team-Workspace~dd0e9307-4deb-40ff-acdf-eed2c29b4c5b/collection/6246212-3c0b1a43-8f28-4c97-9683-8f406c787095?action=share&creator=6246212&active-environment=6246212-1156f553-6a40-41e6-9b52-94742f75b097](https://lively-eclipse-415471.postman.co/workspace/New-Team-Workspace~dd0e9307-4deb-40ff-acdf-eed2c29b4c5b/collection/6246212-3c0b1a43-8f28-4c97-9683-8f406c787095?action=share&creator=6246212&active-environment=6246212-1156f553-6a40-41e6-9b52-94742f75b097)