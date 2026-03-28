#!/bin/bash
set -e

echo "==> Creating SQLite database..."
mkdir -p /var/www/html/database
touch /var/www/html/database/database.sqlite
chown www-data:www-data /var/www/html/database /var/www/html/database/database.sqlite
chmod 664 /var/www/html/database/database.sqlite

echo "==> Writing .env file..."
cat > /var/www/html/.env << 'ENVEOF'
APP_NAME=BOUESTI Accommodation
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
ENVEOF

# Append secrets from Railway environment variables
echo "APP_KEY=${APP_KEY}" >> /var/www/html/.env
echo "APP_URL=${APP_URL:-http://localhost}" >> /var/www/html/.env

echo "==> Running migrations..."
php artisan migrate --force

echo "==> Starting Apache on port 8080..."
exec apache2-foreground
