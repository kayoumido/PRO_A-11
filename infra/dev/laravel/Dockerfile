# use Debian Buster (10) with FPM
FROM php:7.4-fpm

# unlock php deb package
RUN rm /etc/apt/preferences.d/no-debian-php

ARG USER_ID
ARG GROUP_ID

RUN groupadd -f $GROUP_ID
RUN useradd -u $USER_ID -g $GROUP_ID user

# install Laravel's PHP dependencies
# can also do with docker-php-ext-install / docker-php-ext-configure, to check
# https://www.digitalocean.com/community/tutorials/how-to-set-up-laravel-nginx-and-mysql-with-docker-compose
RUN apt-get update && apt-get install -y \
    libpq5 \
    libpq-dev

# install own dependencies
# RUN apt-get install -y git php-zip htop net-tools

RUN docker-php-ext-install pdo_pgsql

# install Composer directly
# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# clone repo and install it at /var/www
# WORKDIR /tmp
# RUN git clone https://github.com/kayoumido/HEIGVD-PRO-A-11.git \
#     && cd HEIGVD-PRO-A-11 \
#     && git checkout develop \
#     && cp -r src/* /var/www/

# make www-data own /var/www
USER user
# RUN chown -R www-data:www-data /var/www

# USER www-data
WORKDIR /var/www

# start PHP-FPM
CMD ["php-fpm"]
