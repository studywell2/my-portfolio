#!/bin/sh
set -e

# Start PHP-FPM in background
php-fpm -D

# Run migrations
php artisan migrate --force

# Only seed if database is empty (first deploy)
USER_COUNT=$(php artisan tinker --execute='echo \App\Models\User::count();' 2>/dev/null || echo "0")
if [ "$USER_COUNT" = "0" ]; then
    php artisan db:seed --force
fi

# Create storage symlink
php artisan storage:link 2>/dev/null || true

# Clear and cache config
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start nginx in foreground
nginx -g 'daemon off;'
