FROM php:8.3-fpm-alpine

WORKDIR /var/www

RUN apk add --no-cache git unzip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

CMD ["php-fpm"]