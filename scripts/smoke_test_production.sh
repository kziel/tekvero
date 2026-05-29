#!/usr/bin/env bash
set -euo pipefail

if [[ -z "${APP_URL:-}" ]]; then
  echo "APP_URL is required"
  exit 1
fi

APP_URL="${APP_URL%/}"
FORM_SMOKE_URL="${FORM_SMOKE_URL:-}"
ASSET_MANIFEST_PATH="${ASSET_MANIFEST_PATH:-/build/manifest.json}"
LOCALE_PATHS="${LOCALE_PATHS:-/pl,/en}"
SITEMAP_PATH="${SITEMAP_PATH:-/sitemap.xml}"

failures=0

check_status() {
  local label="$1"
  local url="$2"
  local expected_codes_csv="$3"

  local code
  code="$(curl -sS -o /dev/null -w "%{http_code}" "$url")"

  IFS=',' read -r -a expected_codes <<< "$expected_codes_csv"
  local ok=0
  for expected in "${expected_codes[@]}"; do
    if [[ "$code" == "$expected" ]]; then
      ok=1
      break
    fi
  done

  if [[ "$ok" -eq 1 ]]; then
    echo "PASS: $label ($url) -> HTTP $code"
  else
    echo "FAIL: $label ($url) -> HTTP $code, expected one of [$expected_codes_csv]"
    failures=$((failures + 1))
  fi
}

check_status "Homepage" "$APP_URL" "200,301,302"
IFS=',' read -r -a locale_paths <<< "$LOCALE_PATHS"
for path in "${locale_paths[@]}"; do
  check_status "Localized page $path" "$APP_URL$path" "200"
done

check_status "Asset manifest" "$APP_URL$ASSET_MANIFEST_PATH" "200"
check_status "Sitemap" "$APP_URL$SITEMAP_PATH" "200"

if [[ -n "$FORM_SMOKE_URL" ]]; then
  # Form endpoints vary by CSRF/auth policy; these statuses usually indicate route exists.
  check_status "Form endpoint" "$FORM_SMOKE_URL" "200,204,302,405,419"
else
  echo "SKIP: Form endpoint check (FORM_SMOKE_URL not set)"
fi

if [[ "$failures" -gt 0 ]]; then
  echo "Smoke test failed with $failures issue(s)."
  exit 1
fi

echo "Smoke test passed."
