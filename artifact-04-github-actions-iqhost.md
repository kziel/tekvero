# Artifact 04: GitHub Actions CI/CD for iqhost.pl

## Purpose
Provide a ready-to-use CI/CD baseline for Tekvero using GitHub Actions with shared-hosting-safe deployment steps.

## Files Added
- `.github/workflows/ci-deploy-iqhost.yml`

## What This Workflow Does
1. Runs CI on pull requests and pushes to main.
2. Builds Tailwind/Vite production assets.
3. Runs Laravel tests.
4. Creates a production package on main.
5. Deploys package to iqhost.pl over SSH/SCP.
6. Runs migration and Laravel cache optimization commands.
7. Performs a homepage smoke check.

## Required GitHub Secrets
Create these repository secrets before enabling deployment:
- `DEPLOY_HOST` (example: ssh.iqhost.pl)
- `DEPLOY_PORT` (example: 22)
- `DEPLOY_USER`
- `DEPLOY_SSH_KEY` (private key in PEM/OpenSSH format)
- `DEPLOY_PATH` (absolute server path to Laravel project root)
- `APP_URL` (https://tekvero.pl)

## Important Hosting Notes for iqhost.pl
- Deployment requires SSH access.
- Domain/web root must map to Laravel public directory.
- If Composer is not available server-side, this workflow already packages vendor.
- Keep queue mode simple on shared hosting:
  - `QUEUE_CONNECTION=database`
- Use Redis for cache/session as available:
  - `CACHE_STORE=redis`
  - `SESSION_DRIVER=redis` (or `database` if needed)

## First-Time Server Prep
Run once on server after first upload:
1. Create `.env` with production values.
2. Run `php artisan key:generate --force` once.
3. Ensure writable permissions on `storage` and `bootstrap/cache`.
4. Ensure cron contains scheduler entry if scheduler is used.

## Optional Hardening
- Add path-based deployment with release folders (`releases/` + `current` symlink).
- Add rollback script to previous release.
- Add health check for form endpoint (not only homepage).
- Add branch protection: require CI pass before merge.

## Fallback If SSH Is Not Available
If iqhost.pl plan does not permit SSH, keep CI only and deploy manually:
1. Run build/package in GitHub Actions.
2. Download artifact from workflow run.
3. Upload via hosting file manager or SFTP.
4. Run required artisan commands via panel terminal or support path.
