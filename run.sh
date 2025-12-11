#!/bin/bash
# setup.sh - Script de inicialização

cp .env.example .env

php artisan key:generate

rm database/database.sqlite

touch database/database.sqlite

composer install

php artisan migrate

php artisan db:seed

php artisan serve --host=0.0.0.0 --port=9000
