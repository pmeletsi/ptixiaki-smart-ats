# SmartRecruit ATS

A Laravel 10 Applicant Tracking System for job listings, candidate applications, and admin management.

## Overview

This application provides:

- Job posting creation and listing
- Candidate application submission with PDF resume upload
- Admin dashboard to review candidates and update statuses
- Email notifications when candidate status changes
- Optional resume analysis using OpenAI

## Key Features

- Public job board: `/`
- Candidate application page: `/apply/{id}`
- Admin login: `/login`
- Admin dashboard: `/dashboard`
- Create new job posting: `/jobs/create`
- Store job posting: `/jobs/store`

## Requirements

- PHP >= 8.1
- MySQL / MariaDB
- Composer
- Local web server or XAMPP
- OpenAI API key (optional, only for resume analysis)

## Setup

1. Copy the environment file:

```bash
cp .env.example .env
```

2. Update database settings in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

3. Add OpenAI API key (optional):

```env
OPENAI_API_KEY=your_openai_api_key_here
```

4. Install dependencies:

```bash
composer install
```

5. Generate the application key:

```bash
php artisan key:generate
```

6. Run database migrations:

```bash
php artisan migrate
```

7. Ensure the `public/uploads` folder exists and is writable.

## Running the Application

Use the built-in server for local development:

```bash
php artisan serve
```

Alternatively, configure XAMPP/Apache to serve the `public/` directory.

## Create Admin User

If no admin user exists, create one using Tinker:

```bash
php artisan tinker
```

Then run:

```php
use App\\Models\\User;
use Illuminate\\Support\\Facades\\Hash;

User::create([
    'name' => 'Administrator',
    'email' => 'admin@smartats.com',
    'password' => Hash::make('Admin123!'),
    'email_verified_at' => now(),
]);
```

## Notes

- Resume files are stored in `public/uploads`.
- `OPENAI_API_KEY` should remain in the backend `.env` and must not be exposed to the frontend.
- Form protection is handled with CSRF tokens and session-based authentication.
- Admin routes are protected by Laravel auth middleware.

## Backend Behavior

The backend handles:

- candidate application forms and resume uploads
- job posting creation and storage
- admin dashboard filtering and candidate management
- status updates and email notifications
- OpenAI resume analysis when enabled

## Dependencies

- `laravel/framework` ^10.10
- `filament/filament` ^2.17
- `openai-php/client` ^0.10.3
- `smalot/pdfparser` ^2.12

## Web Site 

-<img width="1413" height="692" alt="Στιγμιότυπο οθόνης 2026-03-11 233242" src="https://github.com/user-attachments/assets/abd9559b-ebc4-4fa2-8fa4-963c58be0a93" />

