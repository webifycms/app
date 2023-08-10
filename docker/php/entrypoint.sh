#!/bin/sh

setfacl -dm u:www-data:rwX /app

docker-php-entrypoint $@