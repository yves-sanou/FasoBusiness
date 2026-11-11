#!/usr/bin/env bash
set -euo pipefail
: "${DB_HOST:=127.0.0.1}" "${DB_NAME:?DB_NAME requis}" "${DB_USER:?DB_USER requis}" "${DB_PASSWORD:?DB_PASSWORD requis}"
DEST="${BACKUP_DIR:-../backups}"
mkdir -p "$DEST"
STAMP="$(date -u +%Y%m%dT%H%M%SZ)"
MYSQL_PWD="$DB_PASSWORD" mysqldump --host="$DB_HOST" --user="$DB_USER" --single-transaction --routines --triggers "$DB_NAME" | gzip > "$DEST/${DB_NAME}_${STAMP}.sql.gz"
find "$DEST" -type f -name "${DB_NAME}_*.sql.gz" -mtime +14 -delete
