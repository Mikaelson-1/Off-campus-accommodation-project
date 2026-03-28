FROM php:8.4-apache

# Install system dependencies
# NOTE: libpq-dev removed — this app uses SQLite, not PostgreSQL
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libsqlite3-dev \
    libicu-dev \
    unzip \
    git \
    curl \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
# pdo_sqlite is required for SQLite; pdo_pgsql removed (not used)
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    pdo_sqlite \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip \
    intl \
    opcache

# Apply custom php.ini
COPY php.ini /usr/local/etc/php/conf.d/custom.ini

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . .

# Install PHP dependencies (no dev, optimized)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Create the SQLite database file if it doesn't exist
RUN mkdir -p /var/www/html/database \
    && touch /var/www/html/database/database.sqlite

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache \
    && chmod 664 /var/www/html/database/database.sqlite

# Configure Apache virtual host
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

RUN echo '<VirtualHost *:80>\n\
    ServerAdmin webmaster@localhost\n\
    DocumentRoot /var/www/html/public\n\
\n\
    <Directory /var/www/html/public>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
\n\
    ErrorLog ${APACHE_LOG_DIR}/error.log\n\
    CustomLog ${APACHE_LOG_DIR}/access.log combined\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Create startup script
# Railway injects env vars directly — no .env file needed.
# We write them to a .env so Laravel can pick them up via its bootstrap.
RUN printf '#!/bin/bash\nset -e\n\n# Write Railway env vars to .env so Laravel can read them\ncat > /var/www/html/.env <<EOL\nAPP_NAME="${APP_NAME:-BOUESTI Accommodation}"\nAPP_ENV="${APP_ENV:-production}"\nAPP_KEY="${APP_KEY}"\nAPP_DEBUG="${APP_DEBUG:-false}"\nAPP_URL="${APP_URL:-http://localhost}"\nDB_CONNECTION=sqlite\nDB_DATABASE=/var/www/html/database/database.sqlite\nSESSION_DRIVER=database\nCACHE_STORE=database\nQUEUE_CONNECTION=database\nLOG_CHANNEL=stack\nLOG_LEVEL=error\nEOL\n\n# Ensure the SQLite file exists\nmkdir -p /var/www/html/database\ntouch /var/www/html/database/database.sqlite\nchown www-data:www-data /var/www/html/database/database.sqlite\n\n# Run migrations\nphp artisan migrate --force\n\n# Cache for production\nphp artisan config:cache\nphp artisan route:cache\nphp artisan view:cache\n\nexec apache2-foreground\n' > /start.sh \
    && chmod +x /start.sh

# Expose port
EXPOSE 80

CMD ["/start.sh"]
