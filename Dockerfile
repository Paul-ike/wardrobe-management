# Use official PHP 8.2 FPM image
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    libpq-dev \
    nginx \
    supervisor \
    && rm -rf /var/lib/apt/lists/*  # Clean up to reduce image size

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql pdo_pgsql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Copy Nginx config
COPY nginx.conf /etc/nginx/sites-enabled/default

# Copy Supervisor config
COPY supervisord.conf /etc/supervisor/supervisord.conf

# Expose port
EXPOSE 8080

# Start services using Supervisor
CMD ["supervisord", "-n", "-c", "/etc/supervisor/supervisord.conf"]
