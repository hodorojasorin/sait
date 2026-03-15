#!/bin/sh

set -eu

if [ "${DB_CONNECTION:-sqlite}" = "sqlite" ]; then
    DB_FILE="${DB_DATABASE:-database/database.sqlite}"
    DB_DIR=$(dirname "$DB_FILE")

    mkdir -p "$DB_DIR"
    touch "$DB_FILE"
fi

php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
php artisan migrate --force

exec php artisan serve --host=0.0.0.0 --port="${PORT:-8080}"
