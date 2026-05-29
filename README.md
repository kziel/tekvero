# TekVero Website

Single-page marketing website for tekvero.pl, built with Laravel Blade and Tailwind CSS.

## Project Goal

Deliver a high-performance, engineering-focused landing page that communicates reliability, clean execution, and fast collaboration.

## Current Delivery Status

- Phase 1 complete: Laravel baseline and local environment are stable.
- Phase 2 complete: branded UI system, responsive sections, and accessibility foundations are implemented.
- Phase 3 complete: contact backend with validation, honeypot, throttling, and localized mail pipeline.
- Phase 4 complete: SEO metadata, sitemap, smoke checks, and release hardening are in place.
- Multilingual launch complete: Polish and English routes at `/pl` and `/en` with locale cookie + browser-language redirect.

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

Run production smoke checks:

```bash
APP_URL=https://tekvero.pl bash scripts/smoke_test_production.sh
```

Run release profile smoke checks (multilingual defaults):

```bash
APP_URL=https://tekvero.pl bash scripts/smoke_test_release_profile.sh
```

Optional smoke overrides:

```bash
FORM_PATH=/pl/contact
LOCALE_PATHS=/pl,/en
ASSET_MANIFEST_PATH=/build/manifest.json
SITEMAP_PATH=/sitemap.xml
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
- Locale middleware: app/Http/Middleware/SetLocale.php
- Deployment helper scripts: scripts/
- CI workflow: .github/workflows/release-validation.yml
- Planning artifacts: artifact-02 through artifact-10 markdown files

## Release Validation

- CI runs test + build validation on push/PR via `.github/workflows/release-validation.yml`.
- Local regression baseline:
	- `php artisan test`
	- `npm run build`
	- `APP_URL=<target> bash scripts/smoke_test_release_profile.sh`
