# base image
FROM php:8.1-fpm

# copying application directory
COPY . /app

# install dependencies
RUN apt-get update && apt-get install -y \
    zip \
    git \
    curl \
    unzip \
    locales \
    memcached

# clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# adding php extensions installer
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# installing php extensions
RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions gd \
    pdo_mysql \
    intl \
    memcached \
    imagick \
    bcmath \
    opcache

#installing nodejs
RUN apt-get update && apt-get install -y nodejs

# setting working directory
WORKDIR /app

# add user for the application and update permissions
RUN groupadd -g 1000 app-www
RUN useradd -u 1000 -ms /bin/bash -g app-www app-www
RUN chown -R app-www:app-www .
RUN chmod -R 0777 ./runtime
RUN chmod -R 0777 ./public/assets
RUN chmod -R 0755 ./bin/yii

# set current user
USER app-www

# start php-fpm server with port 9000
EXPOSE 9000
CMD ["php-fpm"]


