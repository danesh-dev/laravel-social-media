FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

WORKDIR /var/www/html

COPY . .

# RUN chown -R www-data:www-data /var/www/html

# Copy entrypoint script
COPY entrypoint.sh /usr/local/bin/

COPY custom-php.ini /usr/local/etc/php/conf.d/

# Make entrypoint script executable
RUN chmod +x /usr/local/bin/entrypoint.sh

# Use entrypoint script
ENTRYPOINT [ "/usr/local/bin/entrypoint.sh" ]

# Expose port 80
EXPOSE 80
