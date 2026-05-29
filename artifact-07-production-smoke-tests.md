# Artifact 07: Production Smoke Tests

## Purpose
Add stronger post-deploy validation than a single homepage check.

## Files Added
- scripts/smoke_test_production.sh

## What The Script Checks
- Homepage availability (expects HTTP 200)
- Built assets manifest availability (expects HTTP 200 on /build/manifest.json)
- Optional form endpoint availability with flexible expected statuses

## Inputs
Environment variables:
- APP_URL (required), example: https://tekvero.pl
- FORM_SMOKE_URL (optional), example: https://tekvero.pl/contact
- ASSET_MANIFEST_PATH (optional), default: /build/manifest.json

## Run Manually

```bash
APP_URL=https://tekvero.pl bash scripts/smoke_test_production.sh
```

Optional form check:

```bash
APP_URL=https://tekvero.pl FORM_SMOKE_URL=https://tekvero.pl/contact bash scripts/smoke_test_production.sh
```

## Workflow Integration
Both deployment workflows now call this script after deploy and rollback checks.

Optional repository secret:
- FORM_SMOKE_URL

If FORM_SMOKE_URL is missing, form check is skipped and the script still validates homepage and assets.
