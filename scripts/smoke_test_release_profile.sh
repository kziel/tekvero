#!/usr/bin/env bash
set -euo pipefail

if [[ -z "${APP_URL:-}" ]]; then
  echo "APP_URL is required"
  exit 1
fi

FORM_PATH="${FORM_PATH:-/pl/contact}"
LOCALE_PATHS="${LOCALE_PATHS:-/pl,/en}"
ASSET_MANIFEST_PATH="${ASSET_MANIFEST_PATH:-/build/manifest.json}"
SITEMAP_PATH="${SITEMAP_PATH:-/sitemap.xml}"

APP_URL="${APP_URL%/}"
FORM_SMOKE_URL="${APP_URL}${FORM_PATH}"

APP_URL="$APP_URL" \
FORM_SMOKE_URL="$FORM_SMOKE_URL" \
LOCALE_PATHS="$LOCALE_PATHS" \
ASSET_MANIFEST_PATH="$ASSET_MANIFEST_PATH" \
SITEMAP_PATH="$SITEMAP_PATH" \
bash "$(dirname "$0")/smoke_test_production.sh"
