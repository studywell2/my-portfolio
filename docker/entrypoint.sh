#!/bin/sh
set -e

# Ensure APP_KEY is in Laravel's base64: format
case "$APP_KEY" in
    base64:*) ;;
    *)
        # Generate a proper Laravel key and write it to .env
        NEW_KEY="base64:$(php -r 'echo base64_encode(random_bytes(32));')"
        if [ -f .env ]; then
            sed -i "s|^APP_KEY=.*|APP_KEY=${NEW_KEY}|" .env
        else
            echo "APP_KEY=${NEW_KEY}" > .env
        fi
        export APP_KEY="$NEW_KEY"
        ;;
esac

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
