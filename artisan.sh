#!/usr/bin/env bash

docker exec -it nicomanga-web01 bash -c "cd /var/www/web/ && php artisan $1 $2 $3 $4 $5 $6"

