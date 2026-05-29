# Artifact 05: Release-Based Deploy and Rollback

## Purpose
Upgrade deployment to a safer release model on iqhost.pl:
- each deploy creates a new release folder,
- current points to active release via symlink,
- rollback is a symlink switch,
- shared storage and environment stay persistent.

## Files Added
- .github/workflows/ci-deploy-iqhost-releases.yml

## Required Secrets
- DEPLOY_HOST
- DEPLOY_PORT
- DEPLOY_USER
- DEPLOY_SSH_KEY
- DEPLOY_BASE_PATH
- APP_URL

Notes:
- DEPLOY_BASE_PATH example: /home/username/apps/tekvero
- Active app path will be DEPLOY_BASE_PATH/current

## Server Folder Layout

```text
DEPLOY_BASE_PATH/
  current -> releases/20260529123045-a1b2c3d
  releases/
    20260529123045-a1b2c3d/
    20260528191910-e9f1a2b/
  shared/
    .env
    storage/
    bootstrap/cache/
```

## First-Time Bootstrap (One Time)
Run on server once:

```bash
mkdir -p "$DEPLOY_BASE_PATH/releases"
mkdir -p "$DEPLOY_BASE_PATH/shared/storage"
mkdir -p "$DEPLOY_BASE_PATH/shared/bootstrap/cache"
```

Upload production .env file to:
- DEPLOY_BASE_PATH/shared/.env

Ensure the domain/web root points to:
- DEPLOY_BASE_PATH/current/public

## Deploy Flow
On push to main:
1. CI runs install/build/test.
2. Package is uploaded to server.
3. New release folder is created and extracted.
4. shared/.env and shared storage paths are symlinked.
5. migrate and Laravel caches run on new release.
6. current symlink is switched atomically.
7. Old releases are pruned (keep latest 5).

## Rollback Flow
From Actions UI:
1. Run workflow ci-deploy-iqhost-releases.yml manually.
2. Set rollback_to to a release folder name, for example:
   20260528191910-e9f1a2b
3. Workflow switches current symlink to that release and rebuilds caches.

## How To List Available Releases (Server)

```bash
ls -1dt "$DEPLOY_BASE_PATH/releases"/*
```

## Shared Hosting Notes
- Keep QUEUE_CONNECTION=database for reliability.
- Use Redis for cache and optionally sessions.
- If scheduler is used, keep a single cron entry for schedule:run.

## Safety Advantages Over Flat Deploy
- Deploy is near-atomic (symlink swap).
- Rollback is fast and low-risk.
- Shared writable paths avoid permission drift.
- Keeping last 5 releases protects against bad pushes.
