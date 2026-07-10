FROM php:8.2-fpm-alpine

# Install system deps, PHP extensions, and cleanup build deps in one layer
RUN apk add --no-cache \
    nginx \
    postgresql-dev \
    libpng-dev \
    libzip-dev \
    nodejs \
    npm \
    && docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd zip \
    && apk del libpng-dev libzip-dev

# Get Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Install PHP deps
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Install Node deps and build assets in one layer
COPY package.json package-lock.json ./
COPY . .
RUN npm ci && npm run build && npm prune --production

# Run artisan discovery now that source is copied
RUN composer dump-autoload --optimize && php artisan package:discover --ansi

# Set permissions
RUN chown -R www-data:www-data /var/www/html && chmod -R 775 storage bootstrap/cache

# Configure nginx and entrypoint
COPY docker/nginx.conf /etc/nginx/http.d/default.conf
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 80

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
