# Artifact 09: Go-Live Onboarding Checklist

## Purpose
Provide one consolidated setup checklist for first production deployment on iqhost.pl.

Deployment policy:
- Primary: release workflow (`ci-deploy-iqhost-releases.yml`)
- Fallback only: flat workflow (`ci-deploy-iqhost.yml`)

## 1) GitHub Repository Secrets (Required)
Set these secrets in GitHub repository settings:

- `DEPLOY_HOST` (example: `ssh.iqhost.pl`)
- `DEPLOY_PORT` (example: `22`)
- `DEPLOY_USER` (SSH user)
- `DEPLOY_SSH_KEY` (private deploy key)
- `APP_URL` (example: `https://tekvero.pl`)

For release workflow (`ci-deploy-iqhost-releases.yml`):
- `DEPLOY_BASE_PATH` (example: `/home/username/apps/tekvero`)

Fallback-only (set only if using flat deploy workflow):
- `DEPLOY_PATH` (server path to app root)

Optional:
- `FORM_SMOKE_URL` (example: `https://tekvero.pl/contact`)

## 2) Server Paths (Release Model)
Recommended server layout:

- `<DEPLOY_BASE_PATH>/releases/`
- `<DEPLOY_BASE_PATH>/shared/.env`
- `<DEPLOY_BASE_PATH>/shared/storage/`
- `<DEPLOY_BASE_PATH>/shared/bootstrap/cache/`
- `<DEPLOY_BASE_PATH>/current -> symlink to active release`

Web root should point to:
- `<DEPLOY_BASE_PATH>/current/public`

## 3) One-Time Server Bootstrap
Run once on server:

```bash
bash scripts/bootstrap_iqhost_release_layout.sh /home/username/apps/tekvero
```

Then create real production env file:

- `/home/username/apps/tekvero/shared/.env`

## 4) Production .env Minimum Values
Required baseline:

- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_URL=https://tekvero.pl`
- MySQL credentials (`DB_*`)
- Redis credentials (`REDIS_*`)
- SMTP credentials (`MAIL_*`)
- `CACHE_STORE=redis`
- `SESSION_DRIVER=redis` (or `database` fallback)
- `QUEUE_CONNECTION=database`

## 5) DNS and HTTPS
Before first deploy:

- Domain A/AAAA records point to hosting
- SSL certificate active
- HTTP to HTTPS redirect enabled

## 6) Cron Scheduler
If using Laravel scheduler, add cron:

```cron
* * * * * php /home/username/apps/tekvero/current/artisan schedule:run >> /dev/null 2>&1
```

## 7) First Deployment Order
Recommended order:

1. Push workflow files and scripts to `main`.
2. Configure GitHub secrets.
3. Run server bootstrap script.
4. Upload/create `shared/.env` with real values.
5. Ensure web root points to `current/public`.
6. Trigger release deployment by push to `main`.
7. Verify smoke checks pass.
8. Validate homepage and contact flow manually.

Fallback mode:
- Use flat workflow only if release workflow cannot be used on the hosting plan.

## 8) Post-Deploy Verification
Minimum checks:

- Homepage returns HTTP 200
- Asset manifest returns HTTP 200
- Contact route responds (or is intentionally disabled)
- Form submission path works and sends/stores lead
- No sensitive error output in browser

## 9) Rollback Procedure (Release Model)
To rollback quickly:

1. List releases:

```bash
bash scripts/list_iqhost_releases.sh /home/username/apps/tekvero
```

2. Roll back to selected release:

```bash
bash scripts/rollback_iqhost_release.sh /home/username/apps/tekvero <RELEASE_FOLDER_NAME>
```

3. Re-run smoke checks and confirm business-critical paths.

## 10) Day-2 Operations
Weekly:

- Check app logs and delivery errors
- Verify contact form submissions
- Confirm Redis and MySQL health

Monthly:

- Dependency updates (Laravel/Tailwind patch level)
- Performance check (Lighthouse + server response)
- Backup restore spot check
