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
    libzip-dev \
    htop


# install own dependencies
# needed ?
RUN apt-get install -y git php-zip

# apt cleanup
RUN apt-get autoremove -y

RUN docker-php-ext-install pdo zip

# install Composer directly
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# install Laravel from Composer
RUN /usr/local/bin/composer global require laravel/installer

# copy app to www
# needed ?
COPY . /var/www

# create user and own www
# RUN groupadd -g 1000 www-data
# RUN useradd -u 1000 -ms /bin/bash -g www-data www-data
RUN chown -R www-data:www-data /var/www

# become www-data and expose app
USER www-data

# let other dockers access FPM via port 80
#EXPOSE 9000

CMD ["php-fpm"]
