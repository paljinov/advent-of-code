FROM php:7.4-fpm

WORKDIR /var/www
COPY . /var/www

RUN apt-get update && apt-get install -y \
    curl \
    git \
    unzip \
    zip \
    && pecl install xdebug-2.8.1

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
ENV COMPOSER_ALLOW_SUPERUSER 1
