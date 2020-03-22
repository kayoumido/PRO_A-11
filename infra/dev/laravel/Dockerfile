# use Debian Buster (10) with FPM
FROM php:7.4.3-fpm-buster

# unlock php deb package
RUN rm /etc/apt/preferences.d/no-debian-php

# install Laravel's PHP dependencies
# can also do with docker-php-ext-install / docker-php-ext-configure, to check
# https://www.digitalocean.com/community/tutorials/how-to-set-up-laravel-nginx-and-mysql-with-docker-compose
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    curl \
    libzip-dev

# install own dependencies
RUN apt-get install -y git php-zip htop net-tools

RUN docker-php-ext-install pdo zip

# install Composer directly
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# install Laravel from Composer
RUN /usr/local/bin/composer global require laravel/installer

# node.js installation
RUN curl -sL https://deb.nodesource.com/setup_12.x | bash - && apt-get install -y nodejs

# clone repo and install it at /var/www
WORKDIR /tmp
RUN git clone https://github.com/kayoumido/HEIGVD-PRO-A-11.git \
    && cd HEIGVD-PRO-A-11 \
    && git checkout develop \
    && cp -r src/* /var/www/

# make www-data own /var/www
USER root
RUN chown -R www-data:www-data /var/www

# update dependencies with composer
USER www-data
WORKDIR /var/www
RUN composer install && composer update

# start PHP-FPM
CMD ["php-fpm"]
