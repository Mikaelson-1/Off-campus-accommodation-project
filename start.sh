#!/bin/bash

echo "=== BOUESTI Startup ==="

# ── Storage & cache dirs ──────────────────────────────────────────────────────
mkdir -p /var/www/html/storage/framework/{sessions,views,cache}
mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# ── SQLite database ───────────────────────────────────────────────────────────
mkdir -p /var/www/html/database
touch /var/www/html/database/database.sqlite
chmod 664 /var/www/html/database/database.sqlite

# ── Write .env ────────────────────────────────────────────────────────────────
cat > /var/www/html/.env << 'ENVEOF'
APP_NAME="BOUESTI Accommodation"
APP_ENV=production
APP_DEBUG=false
DB_CONNECTION=sqlite
DB_DATABASE=/var/www/html/database/database.sqlite
SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync
LOG_CHANNEL=stderr
LOG_LEVEL=warning
MAIL_MAILER=log
FILESYSTEM_DISK=local
ENVEOF

echo "APP_URL=${APP_URL:-http://localhost}" >> /var/www/html/.env

# Generate or use APP_KEY
if [ -z "${APP_KEY}" ]; then
    echo "==> Generating APP_KEY..."
    php artisan key:generate --force
else
    echo "APP_KEY=${APP_KEY}" >> /var/www/html/.env
fi

# ── Migrations ────────────────────────────────────────────────────────────────
echo "==> Running migrations..."
php artisan migrate --force || echo "WARNING: Migrations failed"

# ── Start Laravel built-in server (no Apache needed) ─────────────────────────
PORT="${PORT:-8080}"
echo "==> Starting server on 0.0.0.0:${PORT}..."
exec php artisan serve --host=0.0.0.0 --port="${PORT}"
