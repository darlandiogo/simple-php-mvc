FROM php:alpine

RUN docker-php-ext-install pdo_mysql

COPY ./composer*.json ./

RUN composer install
