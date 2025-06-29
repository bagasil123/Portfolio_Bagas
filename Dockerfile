# --- Stage 1: Build Dependencies ---
FROM composer:2 as vendor
WORKDIR /app
COPY database/ database/
COPY composer.json composer.json
COPY composer.lock composer.lock
RUN composer install --ignore-platform-reqs --no-interaction --no-plugins --no-scripts --prefer-dist

# --- Stage 2: Build Application ---
FROM php:8.4-fpm-alpine as app
WORKDIR /var/www/html

# Install system dependencies & PHP extensions
RUN apk add --no-cache \
    nginx \
    supervisor \
    # Common extensions for Laravel
    curl \
    libpng-dev \
    libjpeg-turbo-dev \
    libzip-dev \
    oniguruma-dev \
    libxml2-dev \
&& docker-php-ext-install \
    pdo pdo_mysql \
    gd \
    zip \
    mbstring \
    exif \
    pcntl \
    bcmath

# Copy application code and dependencies
COPY --from=vendor /app/vendor/ /var/www/html/vendor/
COPY . /var/www/html/

# Copy Nginx & Supervisor config
COPY .docker/nginx/default.conf /etc/nginx/http.d/default.conf
COPY .docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port
EXPOSE 8080

# Run Supervisor to manage Nginx and PHP-FPM
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]