FROM php:7.4-fpm

# unlock php deb package
RUN rm /etc/apt/preferences.d/no-debian-php

ARG USER_ID
ARG GROUP_ID

RUN groupadd -f $GROUP_ID
RUN useradd -u $USER_ID -g $GROUP_ID user

# install Laravel's PHP dependencies
RUN apt-get update && apt-get install -y libpq5 libpq-dev

RUN docker-php-ext-install pdo_pgsql

# install Composer directly
# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

USER user
WORKDIR /var/www
CMD ["php-fpm"]
