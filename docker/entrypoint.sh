#!/bin/bash

# Set proper permissions
chmod -R 775 /var/www/storage
chown -R www-data:www-data /var/www/storage

composer install

if [ ! -f .env ]; then
    echo ".env does not exist, creating it from .env.example"

    cp .env.example .env
    php artisan key:generate
fi

php artisan migrate --force

php artisan optimize:clear

exec "$@"
