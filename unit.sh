#!/usr/bin/env bash

docker exec -it nicomanga-web01 bash -c "cd /var/www/web/ && ./vendor/bin/phpunit"