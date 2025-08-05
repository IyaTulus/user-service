FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git unzip zip curl libzip-dev libpng-dev libonig-dev libxml2-dev

RUN docker-php-ext-install pdo pdo_mysql zip mbstring xml bcmath

WORKDIR /var/www

COPY . .

EXPOSE 8000

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]