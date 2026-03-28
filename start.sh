#!/bin/bash
set -e

# Railway injects $PORT — tell Apache to listen on it
APP_PORT="${PORT:-8080}"

# Update Apache to listen on the correct port
sed -i "s/Listen 80/Listen ${APP_PORT}/" /etc/apache2/ports.conf 2>/dev/null || true
sed -i "s/<VirtualHost \*:8080>/<VirtualHost *:${APP_PORT}>/" /etc/apache2/sites-available/000-default.conf

# Write the .env file from Railway environment variables
cat > /var/www/html/.env << ENVEOF
APP_NAME=${APP_NAME:-BOUESTI Accommodation}
APP_ENV=${APP_ENV:-production}
APP_KEY=${APP_KEY}
APP_DEBUG=${APP_DEBUG:-false}
APP_URL=${APP_URL:-http://localhost}
DB_CONNECTION=sqlite
DB_DATABASE=/var/www/html/database/database.sqlite
SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync
LOG_CHANNEL=stderr
LOG_LEVEL=warning
ENVEOF

# Ensure SQLite DB file exists and is writable by www-data
mkdir -p /var/www/html/database
touch /var/www/html/database/database.sqlite
chown www-data:www-data /var/www/html/database /var/www/html/database/database.sqlite
chmod 664 /var/www/html/database/database.sqlite

# Run Laravel migrations (idempotent — safe to run on every start)
php artisan migrate --force

# Cache config/routes/views for production performance
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start Apache in foreground
exec apache2-foreground
