FROM php:8.3-cli

WORKDIR /app

COPY --from=composer:2 /usr/bin/compoer /usr/bin/composer

COPY composer.json composer.lock* ./

COPY . .

EXPOSE 8000

CMD ["php", "-S", "0.0.0.0.:8000", "-t", "/app"]