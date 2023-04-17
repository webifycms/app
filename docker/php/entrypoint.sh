#!/bin/sh

setfacl -dm u:www-data:rwX /app

composer install

docker-php-entrypoint $@