FROM php:8.1-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring xml

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www

# Copy composer files first (agar cache efisien)
COPY composer.json composer.lock ./

# Install PHP dependencies (with cache)
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Copy semua project files
COPY . .

# Set permission storage/logs jika perlu
RUN mkdir -p storage/logs && chmod -R 775 storage && chown -R www-data:www-data storage

# Copy default .env jika diperlukan
COPY .env.example .env

# Expose port
EXPOSE 8000

# Jalankan built-in server
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
