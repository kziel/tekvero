# Artifact 08: Deploy Preflight and Secret Validation

Purpose
Improve deployment reliability by validating required deployment environment variables before any server action runs.

Files Added
- scripts/validate_deploy_env.sh

What It Validates
- Required deployment connection variables
  - DEPLOY_HOST
  - DEPLOY_PORT
  - DEPLOY_USER
  - DEPLOY_SSH_KEY
- Required target path variable
  - flat workflow mode: DEPLOY_PATH
  - release workflow mode: DEPLOY_BASE_PATH
- Required URL variable
  - APP_URL
- Optional form smoke URL format
  - FORM_SMOKE_URL must be full http(s) URL if set

Modes
- flat: validates for ci-deploy-iqhost.yml
- release: validates for ci-deploy-iqhost-releases.yml

Manual Usage
- Flat deploy mode:
  DEPLOY_HOST=x DEPLOY_PORT=22 DEPLOY_USER=u DEPLOY_SSH_KEY=k DEPLOY_PATH=/path APP_URL=https://tekvero.pl bash scripts/validate_deploy_env.sh flat

- Release deploy mode:
  DEPLOY_HOST=x DEPLOY_PORT=22 DEPLOY_USER=u DEPLOY_SSH_KEY=k DEPLOY_BASE_PATH=/path APP_URL=https://tekvero.pl bash scripts/validate_deploy_env.sh release

Result
Deploy workflows now fail fast with explicit missing-variable messages instead of failing later in SCP/SSH steps.
