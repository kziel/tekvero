#!/usr/bin/env bash
set -euo pipefail

if [[ $# -lt 1 ]]; then
  echo "Usage: $0 <DEPLOY_BASE_PATH>"
  exit 1
fi

BASE_PATH="$1"
RELEASES_PATH="$BASE_PATH/releases"
CURRENT_PATH="$BASE_PATH/current"

if [[ ! -d "$RELEASES_PATH" ]]; then
  echo "Releases path not found: $RELEASES_PATH"
  exit 1
fi

CURRENT_TARGET=""
if [[ -L "$CURRENT_PATH" ]]; then
  CURRENT_TARGET="$(readlink "$CURRENT_PATH")"
fi

echo "Current symlink: ${CURRENT_TARGET:-not set}"
echo "Available releases:"

found=0
while IFS= read -r path; do
  found=1
  marker=" "
  if [[ "$path" == "$CURRENT_TARGET" ]]; then
    marker="*"
  fi
  echo "${marker} $(basename "$path")"
done < <(ls -1dt "$RELEASES_PATH"/* 2>/dev/null || true)

if [[ $found -eq 0 ]]; then
  echo "(none)"
fi
