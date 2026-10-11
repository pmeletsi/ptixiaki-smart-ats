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

## Web Site for users

<img width="1413" height="692" alt="Στιγμιότυπο οθόνης 2026-03-11 233242" src="https://github.com/user-attachments/assets/abd9559b-ebc4-4fa2-8fa4-963c58be0a93" />
<img width="1365" height="665" alt="Στιγμιότυπο οθόνης 2026-03-11 233224" src="https://github.com/user-attachments/assets/8cf6938d-65eb-4b0f-a4b9-02ebf9098d88" />
<img width="1415" height="737" alt="Στιγμιότυπο οθόνης 2026-03-11 233141" src="https://github.com/user-attachments/assets/267f519f-d196-4a2e-b4a0-e7466fc452a7" />

## Web Site for Admin

<img width="635" height="610" alt="Στιγμιότυπο οθόνης 2026-03-12 012247" src="https://github.com/user-attachments/assets/06f23283-c3d6-4613-b749-e4618b27c3ad" />
<img width="1422" height="730" alt="Στιγμιότυπο οθόνης 2026-03-11 233330" src="https://github.com/user-attachments/assets/a3a52962-5bfd-472d-93da-a24796cedc44" />
<img width="1393" height="721" alt="Στιγμιότυπο οθόνης 2026-03-11 233409" src="https://github.com/user-attachments/assets/fc854626-556d-4471-993c-0823ec33464c" />
<img width="1432" height="730" alt="Στιγμιότυπο οθόνης 2026-03-12 000400" src="https://github.com/user-attachments/assets/3d8aafd1-f7f4-46a0-9573-45c533d13625" />
<img width="1289" height="584" alt="Στιγμιότυπο οθόνης 2026-03-11 035915" src="https://github.com/user-attachments/assets/d43e43f0-d7b9-4390-8a3f-0afede0b6f9a" />
<img width="1411" height="729" alt="Στιγμιότυπο οθόνης 2026-03-12 004544" src="https://github.com/user-attachments/assets/d5cda625-0e27-414b-bc11-6972867d98ba" />

## Dashboard HR (Admin User)

<img width="1410" height="731" alt="Στιγμιότυπο οθόνης 2026-03-12 004921" src="https://github.com/user-attachments/assets/b0d7c34d-fd9e-4e00-b3ca-9a95bfb3c9ca" />
<img width="1411" height="708" alt="Στιγμιότυπο οθόνης 2026-03-12 004947" src="https://github.com/user-attachments/assets/83a95658-f800-42c4-a085-53b55d3af570" />
<img width="1411" height="692" alt="Στιγμιότυπο οθόνης 2026-03-12 004730" src="https://github.com/user-attachments/assets/64637fc9-10fa-4916-b906-c52390cc3e88" />
<img width="1395" height="700" alt="Στιγμιότυπο οθόνης 2026-03-12 004835" src="https://github.com/user-attachments/assets/86b334ad-f28f-45e0-8800-2999cd2c225c" />
<img width="1056" height="620" alt="Στιγμιότυπο οθόνης 2026-03-12 010409" src="https://github.com/user-attachments/assets/df8dd8bc-72f5-48ad-8a20-9160e7d8b00b" />
<img width="1053" height="544" alt="Στιγμιότυπο οθόνης 2026-03-12 010037" src="https://github.com/user-attachments/assets/393d465d-48b9-4562-8a37-3114290ec406" />

## MySQL

<img width="1011" height="710" alt="Στιγμιότυπο οθόνης 2026-03-11 232112" src="https://github.com/user-attachments/assets/87bf96f1-06ef-4ee3-89ce-bf763eaf9df8" />












