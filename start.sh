#!/bin/bash

echo "=== BOUESTI Accommodation Startup ==="

# ── 1. Ensure storage dirs exist and are writable ────────────────────────────
mkdir -p /var/www/html/storage/framework/{sessions,views,cache}
mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# ── 2. Create SQLite database ─────────────────────────────────────────────────
mkdir -p /var/www/html/database
touch /var/www/html/database/database.sqlite
chmod 664 /var/www/html/database/database.sqlite
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

# ── 3. Write .env (quoted heredoc = no expansion inside block) ────────────────
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
BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
MAIL_MAILER=log
ENVEOF

# ── 4. Append dynamic Railway env vars ───────────────────────────────────────
echo "APP_URL=${APP_URL:-http://localhost}" >> /var/www/html/.env

# Generate APP_KEY if Railway hasn't set it
if [ -z "${APP_KEY}" ]; then
    echo "==> No APP_KEY set — generating one..."
    cd /var/www/html && php artisan key:generate --force
else
    echo "APP_KEY=${APP_KEY}" >> /var/www/html/.env
fi

# ── 5. Run migrations (non-fatal — log error but keep going) ─────────────────
echo "==> Running migrations..."
cd /var/www/html && php artisan migrate --force && echo "==> Migrations OK" || echo "==> WARNING: Migrations failed — continuing anyway"

# ── 6. Start Apache ───────────────────────────────────────────────────────────
echo "==> Starting Apache on port 8080..."
exec apache2-foreground
