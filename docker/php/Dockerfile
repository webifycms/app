FROM php:8.2-fpm-alpine

# copy PHP extension installer image binary into the container
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

# installing php extensions
RUN chmod +x /usr/local/bin/install-php-extensions && \
    IPE_ICU_EN_ONLY=1 install-php-extensions gd \
    pdo_mysql \
    intl \
    bcmath \
    opcache \
    redis

# copy Composer binary into the container
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# sets working directory
WORKDIR /var/www/html

# copy application files to the working directory and change ownership
COPY . .

# expose port 9000 and start php-fpm
EXPOSE 9000
CMD ["php-fpm"]