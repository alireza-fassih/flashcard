
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


podman run -dt \
--name mysql \
--pod php_workspace \
--security-opt label=disable \
--env MYSQL_ROOT_PASSWORD=root \
docker.io/library/mysql