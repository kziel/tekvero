# Tekvero Website

Single-page marketing website for tekvero.pl, built with Laravel Blade and Tailwind CSS.

## Project Goal

Deliver a high-performance, engineering-focused landing page that communicates reliability, clean execution, and fast collaboration.

## Current Delivery Status

- Phase 1 complete: Laravel project baseline and local environment are running.
- Phase 2 complete: design tokens, reusable Blade components, and section scaffold are implemented.
- Phase 3 in progress: final copy, section refinement, and contact backend wiring.
- CI/CD intentionally deferred until page delivery is complete.

## Architecture

- Backend: Laravel 13 + Blade
- Frontend: Tailwind CSS 4 + Vanilla JavaScript
- Database (local default): MySQL
- Planned production stack: MySQL + Redis + SMTP on iqhost.pl

## Visual Direction

- Canvas: #0F172A
- Accent: #10B981
- High-contrast text: #F8FAFC
- Muted text: #64748B
- Layout style: single-page, conversion-first, low cognitive load

## Local Setup

### Prerequisites

- PHP 8.3+
- Composer
- Node.js and npm
- MySQL running locally

### First-time Setup

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
```

## Run Locally

Use two terminals.

Terminal 1:

```bash
php artisan serve
```

Terminal 2:

```bash
npm run dev
```

Open:

- http://127.0.0.1:8000

## Useful Commands

Run tests:

```bash
php artisan test
```

Build production assets:

```bash
npm run build
```

## Troubleshooting

If pages fail with database or session errors:

```bash
php artisan migrate
```

If environment changes are not reflected:

```bash
php artisan config:clear
```

If frontend assets are missing:

```bash
npm run build
```

## Key Project Files

- Landing page template: resources/views/welcome.blade.php
- Reusable UI components: resources/views/components/
- Design tokens and UI styles: resources/css/app.css
- Routes: routes/web.php
- Deployment helper scripts: scripts/
- Planning artifacts: artifact-02 through artifact-10 markdown files

## Next Product Work

- Finalize production copy in all sections
- Implement contact form backend (validation, honeypot, rate limit, mail fallback)
- Add focused feature tests for contact flow
- Perform accessibility and Lighthouse optimization pass
