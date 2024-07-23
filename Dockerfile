FROM php:8.2-apache

# Install necessary packages and PHP extensions
RUN apt-get update && apt-get install -y \
    libpq-dev \
    nodejs \
    npm \
    supervisor \
    && docker-php-ext-install pdo pdo_pgsql


# Set the working directory
WORKDIR /var/www/html

# Copy application files
COPY . .

# Change ownership of the application files
RUN chown -R www-data:www-data /var/www/html

# Copy custom php.ini file
COPY custom-php.ini /usr/local/etc/php/conf.d/


# Copy entrypoint script
COPY entrypoint.sh /usr/local/bin/

# Copy supervisord configuration file
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Make entrypoint script executable
RUN chmod +x /usr/local/bin/entrypoint.sh

# Use entrypoint script
ENTRYPOINT [ "/usr/local/bin/entrypoint.sh" ]

# Expose port 80
EXPOSE 80
