#!/usr/bin/env bash

docker compose start
docker exec -it sdiwpil-back-end-service service nginx start -d
docker exec -it sdiwpil-back-end-service service php8.1-fpm start -d
docker exec -itd sdiwpil-front-end-service yarn dev

declare -a nginx_containers_to_be_run=( "sdiwpil-back-end-service" "sdiwpil-nginx-service" "sdiwpil-front-end-service" )
for nginx_container in "${nginx_containers_to_be_run[@]}"
do
  docker exec -it "$nginx_container" service nginx start -d
done
