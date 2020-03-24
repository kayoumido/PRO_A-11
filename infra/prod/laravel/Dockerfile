# use Debian Buster (10) with FPM
FROM php:7.4.3-fpm-buster

# work directly from www directory
WORKDIR /var/www

# install Laravel's PHP dependencies
# can also do with docker-php-ext-install / docker-php-ext-configure, to check
RUN apt update && apt install -y \
    php7.4-bcmath \
    php7.4-ctype \
    php7.4-fileinfo \
    php7.4-json \
    php7.4-mbstring \
    php7.4-openssl \
    php7.4-pdo \
    php7.4-tokenizer \
    php7.4-xml

# install own dependencies
# needed ?
RUN apt install -y git

# apt cleanup
RUN apt clean

# install Composer directly
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# install Laravel from Composer
RUN /usr/local/bin/composer global require laravel/installer

# copy app to www
# needed ?
COPY . /var/www

# create user and own www
RUN groupadd -g 1000 www-data
RUN useradd -u 1000 -ms /bin/bash -g www-data www-data
RUN chown -R www-data:www-data /var/www

# become www-data and expose app
USER www-data
EXPOSE 8080
CMD ["php-fpm"]
