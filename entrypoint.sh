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

# Wait for the database to be ready
until pg_isready -h db -U "${DB_USERNAME}"; do
  echo "Waiting for database..."
  sleep 2
done

php artisan migrate --force

php artisan key:generate --force

php artisan serve --port=$PORT --host=0.0.0.0 --env=.env

exec docker-php-entrypoint "$@"
