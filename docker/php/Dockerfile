# base image
FROM php:8.1-fpm

# installing required apps
RUN apt-get update > /dev/null && apt-get install -y \
    git \
    nano \
    unzip

# adding php extensions installer
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# installing php extensions
RUN chmod +x /usr/local/bin/install-php-extensions && \
    IPE_ICU_EN_ONLY=1 install-php-extensions gd \
    pdo_mysql \
    intl \
    bcmath \
    opcache \
    redis

# copying application directory
COPY . /app

# install composer 
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# modify user
RUN usermod -u 1000 www-data

# changing the ownership
RUN chown -R www-data:1000 /app

# change the current user to "www-data"
USER www-data

# setting working directory
WORKDIR /app

