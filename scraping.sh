#!/usr/bin/env bash

# dockerに入るのめんどくさい人用のスクレイピング実行ファイル

docker exec -it nicomanga-web01 bash -c "cd /var/www/web/ && php artisan scraping:run"

