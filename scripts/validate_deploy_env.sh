#!/usr/bin/env bash
set -euo pipefail

MODE="${1:-deploy}"

require_var() {
  local name="$1"
  if [[ -z "${!name:-}" ]]; then
    echo "Missing required variable: $name"
    exit 1
  fi
}

require_var "DEPLOY_HOST"
require_var "DEPLOY_PORT"
require_var "DEPLOY_USER"
require_var "DEPLOY_SSH_KEY"
require_var "APP_URL"

if [[ "$MODE" == "flat" ]]; then
  require_var "DEPLOY_PATH"
else
  require_var "DEPLOY_BASE_PATH"
fi

if [[ -n "${FORM_SMOKE_URL:-}" ]]; then
  case "$FORM_SMOKE_URL" in
    http://*|https://*) ;;
    *)
      echo "FORM_SMOKE_URL must start with http:// or https://"
      exit 1
      ;;
  esac
fi

case "$APP_URL" in
  http://*|https://*) ;;
  *)
    echo "APP_URL must start with http:// or https://"
    exit 1
    ;;
esac

echo "Deployment environment validation passed for mode: $MODE"
