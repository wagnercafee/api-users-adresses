FROM php:8.4-cli-alpine

RUN apk add --no-cache \
    git \
    curl \
    zip \
    unzip \
    sqlite-dev \
    oniguruma-dev \
    libxml2-dev

RUN docker-php-ext-install pdo pdo_sqlite mbstring xml bcmath

COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN cp .env.example .env

RUN composer install --no-interaction --no-scripts --prefer-dist

RUN php artisan key:generate

RUN touch database/database.sqlite

RUN php artisan migrate --force

RUN php artisan db:seed --force

RUN chmod -R 775 storage bootstrap/cache

EXPOSE 9000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=9000"]
