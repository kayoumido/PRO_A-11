# use Debian Buster (10) with FPM
FROM php:7.4.3-fpm-buster

# work directly from www directory
WORKDIR /var/www

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
# needed ?
RUN apt-get install -y git php-zip htop net-tools

# apt cleanup
RUN apt-get autoremove -y

RUN docker-php-ext-install pdo zip

# install Composer directly
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# install Laravel from Composer
RUN /usr/local/bin/composer global require laravel/installer

# node.js installation
RUN curl -sL https://deb.nodesource.com/setup_12.x | bash - && apt-get install -y nodejs

WORKDIR /var/www/

# copy app to www
# needed ?
# COPY . /var/www


# Add user for laravel application
RUN useradd -u 1000 -s /bin/bash -g www-data laravel

# www-data own www
RUN chown -R laravel:www-data /var/www

# become laravel and expose app
USER laravel
# USER www-data 

# let other dockers access FPM via port 80
# EXPOSE 9000

CMD ["php-fpm"]
