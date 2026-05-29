#!/usr/bin/env bash
set -euo pipefail

if [[ $# -lt 1 ]]; then
  echo "Usage: $0 <DEPLOY_BASE_PATH>"
  exit 1
fi

BASE_PATH="$1"
RELEASES_PATH="$BASE_PATH/releases"
SHARED_PATH="$BASE_PATH/shared"
CURRENT_PATH="$BASE_PATH/current"

mkdir -p "$RELEASES_PATH"
mkdir -p "$SHARED_PATH/storage"
mkdir -p "$SHARED_PATH/bootstrap/cache"

if [[ ! -f "$SHARED_PATH/.env" ]]; then
  cat > "$SHARED_PATH/.env.example" <<'EOF'
APP_NAME=Tekvero
APP_ENV=production
APP_DEBUG=false
APP_URL=https://tekvero.pl

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
REDIS_PASSWORD=
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.example.com
MAIL_PORT=587
MAIL_USERNAME=CHANGE_ME
MAIL_PASSWORD=CHANGE_ME
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=hello@tekvero.pl
MAIL_FROM_NAME="Tekvero"
EOF
  echo "Created $SHARED_PATH/.env.example"
  echo "Create $SHARED_PATH/.env with real secrets before first deploy."
fi

if [[ ! -L "$CURRENT_PATH" ]]; then
  echo "No current symlink yet. It will be created by first release deployment."
fi

echo "Bootstrap complete"
echo "Base: $BASE_PATH"
echo "Releases: $RELEASES_PATH"
echo "Shared: $SHARED_PATH"
