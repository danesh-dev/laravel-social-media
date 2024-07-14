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

# Create a new PostgreSQL user and database if they don't exist
psql -h db -U postgres -tc "SELECT 1 FROM pg_roles WHERE rolname='${DB_USERNAME}'" | grep -q 1 || psql -h db -U postgres -c "CREATE USER ${DB_USERNAME} WITH PASSWORD '${DB_PASSWORD}';"
psql -h db -U postgres -tc "SELECT 1 FROM pg_database WHERE datname='${DB_DATABASE}'" | grep -q 1 || psql -h db -U postgres -c "CREATE DATABASE ${DB_DATABASE};"
psql -h db -U postgres -c "GRANT ALL PRIVILEGES ON DATABASE ${DB_DATABASE} TO ${DB_USERNAME};"

# Run migrations and check if they were successful
echo "Running migrations..."
if php artisan migrate --force; then
  echo "Migrations completed successfully."
else
  echo "Migrations failed."
  exit 1
fi

# Generate application key
php artisan key:generate --force

# Start the Laravel development server
php artisan serve --port=$PORT --host=0.0.0.0 --env=.env

# Execute the main container command
exec docker-php-entrypoint "$@"
