#!/usr/bin/env bash

docker exec -it nicomanga-web01 bash -c "cd /var/www/web/ && composer $1 $2 $3 $4 $5 $6"

