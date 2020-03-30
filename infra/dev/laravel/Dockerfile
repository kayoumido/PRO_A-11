FROM php:7.4-fpm

# unlock php deb package
RUN rm /etc/apt/preferences.d/no-debian-php

# Raw code till i haven't found a way to pass .env file values
ENV USER_ID 1000
ENV GROUP_ID 1000

RUN groupadd -f $GROUP_ID
RUN useradd -u $USER_ID -g $GROUP_ID user

RUN mkdir /home/user

RUN chown -R $USER_ID:$GROUP_ID /home/user

RUN chown -R $USER_ID:$GROUP_ID /var/www


# install Laravel's PHP dependencies
RUN apt-get update && apt-get install -y libpq5 libpq-dev zip unzip git libzip-dev

# install node + npm

RUN curl -sL https://deb.nodesource.com/setup_12.x | bash - 
RUN apt-get install -y nodejs

# install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install pdo_pgsql zip

USER user

WORKDIR /var/www

CMD ["php-fpm"]
