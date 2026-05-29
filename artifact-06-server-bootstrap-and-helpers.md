# Artifact 06: Server Bootstrap and Release Helpers

## Purpose
Provide practical helper scripts for iqhost.pl release-based operations:
- one-time server layout bootstrap,
- release listing,
- manual rollback.

## Files Added
- scripts/bootstrap_iqhost_release_layout.sh
- scripts/list_iqhost_releases.sh
- scripts/rollback_iqhost_release.sh

## 1) One-Time Bootstrap
Run on server:

```bash
bash scripts/bootstrap_iqhost_release_layout.sh /home/username/apps/tekvero
```

What it does:
- creates releases and shared directories,
- creates shared .env.example if .env does not exist,
- prints next-step notice.

## 2) List Releases
Run on server:

```bash
bash scripts/list_iqhost_releases.sh /home/username/apps/tekvero
```

Output shows:
- current symlink target,
- available release folders,
- active release marked with an asterisk.

## 3) Manual Rollback
Run on server:

```bash
bash scripts/rollback_iqhost_release.sh /home/username/apps/tekvero 20260529123045-a1b2c3d
```

What it does:
- switches current symlink to selected release,
- attempts Laravel cache refresh commands.

## Recommended First Use Sequence
1. Run bootstrap script.
2. Upload/create shared .env with real production secrets.
3. Ensure web root points to current/public.
4. Trigger release workflow from GitHub Actions.
5. Use list script to verify active release.

## Safety Notes
- Keep shared .env out of repository.
- Keep at least 3 previous releases.
- Verify homepage and contact form after every deploy/rollback.
