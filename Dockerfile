FROM php:apache

# Установка необходимых расширений
RUN docker-php-ext-install pdo pdo_mysql