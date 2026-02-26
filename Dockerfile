FROM php:8.3-fpm

WORKDIR /var/www/html

COPY --from=composer:2 /usr/bin/compoer /usr/bin/composer

COPY composer.json composer.lock* ./
RUN composer install --no-interaction --prefer-dist --no-progress

COPY . .