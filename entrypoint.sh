#!/bin/bash
set -e

# Check if composer dependencies are installed
if [ ! -f "vendor/autoload.php" ]; then
    composer install --no-progress --no-interaction
fi

# Check if .env file exists, if not copy from .env.example
if [ ! -f ".env" ]; then
    cp .env.example .env
fi

# Run npm install and build
npm install
# npm run dev

# Run migrations and other Laravel setup commands
php artisan migrate --force
php artisan key:generate --force

# Start Laravel Reverb
php artisan reverb:start

# Start the Laravel development server
php artisan serve --port=8000 --host=0.0.0.0 --env=.env

exec docker-php-entrypoint "$@"
