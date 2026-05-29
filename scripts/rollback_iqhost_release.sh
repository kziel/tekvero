#!/usr/bin/env bash
set -euo pipefail

if [[ $# -lt 2 ]]; then
  echo "Usage: $0 <DEPLOY_BASE_PATH> <RELEASE_FOLDER_NAME>"
  exit 1
fi

BASE_PATH="$1"
RELEASE_NAME="$2"
RELEASES_PATH="$BASE_PATH/releases"
CURRENT_PATH="$BASE_PATH/current"
TARGET_RELEASE="$RELEASES_PATH/$RELEASE_NAME"

if [[ ! -d "$TARGET_RELEASE" ]]; then
  echo "Release not found: $TARGET_RELEASE"
  exit 1
fi

ln -sfn "$TARGET_RELEASE" "$CURRENT_PATH"

echo "Switched current -> $TARGET_RELEASE"

if command -v php >/dev/null 2>&1; then
  cd "$CURRENT_PATH"
  php artisan optimize:clear || true
  php artisan config:cache || true
  php artisan route:cache || true
  php artisan view:cache || true
  echo "Laravel caches refreshed"
else
  echo "php not found in PATH; skipped artisan cache commands"
fi
