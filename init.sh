
podman pod create --name php_workspace -p 8090:80

podman run -dt \
--name nginx \
--pod php_workspace \
--security-opt label=disable \
--volume /home/alireza/Documents/podman-containers/php-mysql-nginx/nginx-cnfd:/etc/nginx/conf.d:ro \
--volume /home/alireza/Documents/podman-containers/php-mysql-nginx/scripts:/var/www/ \
docker.io/library/nginx:latest

podman run -dt \
--name php \
--pod php_workspace \
--security-opt label=disable \
--volume /home/alireza/Documents/podman-containers/php-mysql-nginx/scripts:/var/www/:rw \
docker.io/library/php:fpm

## setup php

podman exec -it php /bin/bash
docker-php-ext-install mysqli pdo pdo_mysql

###


podman run -dt \
--name mysql \
--pod php_workspace \
--security-opt label=disable \
--env MYSQL_ROOT_PASSWORD=root \
docker.io/library/mysql

## setup mysql
podman exec -it mysql /bin/bash
mysql -u root -p

create database flashcard;
create user 'flashcard'@'localhost' IDENTIFIED BY 'flashcard';
create user 'flashcard'@'127.0.0.1' IDENTIFIED BY 'flashcard';

GRANT ALL PRIVILEGES ON  flashcard.* to 'flashcard'@'127.0.0.1';
ALTER DATABASE flashcard CHARACTER SET 'utf8';
ALTER DATABASE flashcard COLLATE = 'utf8_bin';


## create tables from create-db.sh
podman exec -it mysql /bin/bash
mysql -u root -p

use flashcard;