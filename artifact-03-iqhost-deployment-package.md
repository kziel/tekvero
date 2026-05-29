# Artifact 03: iqhost.pl Deployment Package

## Purpose
Provide a practical, plain-production deployment guide for Tekvero on iqhost.pl using Laravel + Blade + Tailwind 4 + MySQL + Redis.

## Final Stack (Locked)
- Hosting: iqhost.pl
- App: Laravel (Blade)
- Frontend: Tailwind CSS 4 + Vanilla JavaScript
- Database: MySQL
- Cache: Redis
- Mail: SMTP
- Build: assets precompiled before upload/deploy

---

## A) iqhost.pl Readiness Checklist

## Hosting and Runtime
- [ ] PHP version is 8.2+ (prefer 8.3)
- [ ] Required PHP extensions enabled (common Laravel set)
- [ ] Domain can point to Laravel public directory
- [ ] SSL enabled and HTTPS forced
- [ ] SSH access is available (preferred)
- [ ] Composer available on server or deployment process can upload vendor
- [ ] Cron jobs available

## Services
- [ ] MySQL database and user created
- [ ] Redis host/port/password provided
- [ ] SMTP credentials available

## Security and Access
- [ ] File permissions can be set for storage and bootstrap/cache
- [ ] App secrets can be stored in server env or .env safely
- [ ] Backup policy known (files + database)

---

## B) Production Environment Template (.env.production example)
Copy this template and fill with real values.

```dotenv
APP_NAME=Tekvero
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://tekvero.pl

LOG_CHANNEL=stack
LOG_LEVEL=warning

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tekvero_prod
DB_USERNAME=tekvero_user
DB_PASSWORD=CHANGE_ME

CACHE_STORE=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=database

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=CHANGE_ME_IF_NEEDED
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.example.com
MAIL_PORT=587
MAIL_USERNAME=CHANGE_ME
MAIL_PASSWORD=CHANGE_ME
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=hello@tekvero.pl
MAIL_FROM_NAME="Tekvero"

# Optional anti-spam tuning
CONTACT_RATE_LIMIT=5
CONTACT_RATE_WINDOW=1
```

Notes:
- Keep QUEUE_CONNECTION=database for simplest shared-hosting behavior.
- If Redis sessions are unstable on hosting, switch SESSION_DRIVER=database.

---

## C) First Deployment Sequence (Safe and Plain)

## 1. Build Locally or in CI
- Install PHP and JS dependencies.
- Build frontend assets for production.
- Ensure vendor directory exists if server Composer is unavailable.

Suggested command sequence:

```bash
composer install --no-dev --optimize-autoloader
npm ci
npm run build
php artisan test
```

## 2. Upload Project to Hosting
- Upload Laravel app files to target directory.
- Ensure web root maps to public directory.
- Upload built assets from public/build.

## 3. Configure Environment
- Add production .env values on server.
- Generate APP_KEY once if not already set.

```bash
php artisan key:generate --force
```

## 4. Prepare Database
- Run migrations.

```bash
php artisan migrate --force
```

## 5. Optimize App

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 6. Permissions
Set writable permissions for:
- storage/
- bootstrap/cache/

## 7. Scheduler (if needed)
Add one cron entry:

```cron
* * * * * php /path/to/project/artisan schedule:run >> /dev/null 2>&1
```

---

## D) Contact Form Baseline (Production)
- Validate all fields server-side.
- Use CSRF protection.
- Add honeypot hidden field.
- Add per-IP rate limiting for submit route.
- Log failures without exposing sensitive internals to user.

---

## E) Post-Deploy Verification Checklist
- [ ] Homepage loads on HTTPS
- [ ] CSS and JS assets are served correctly
- [ ] Contact form success path works
- [ ] Contact form validation errors show correctly
- [ ] Email delivery confirmed
- [ ] Redis cache is active
- [ ] No APP_DEBUG leakage
- [ ] Robots/sitemap/meta tags are correct

---

## F) Minimal Rollback Procedure
- Keep previous deployment package available.
- If issue occurs:
  - restore previous code package,
  - restore previous .env if changed,
  - clear and rebuild caches.

```bash
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## G) Day-2 Operations
- Weekly:
  - check error logs,
  - verify contact delivery,
  - run dependency security checks.
- Monthly:
  - performance review,
  - backup restore spot test,
  - update Laravel/Tailwind patch versions.
