

# 

## 開発環境

| | |
| --- | ---|
| php | 7.3.* |
| MySQL | 8.0.* |
| ip | 192.168.99.100 |
| mysql_database | laravel |
| mysql_user     | laravel |
| mysql_password | laravel |
| doeckr WEB     | http://192.168.99.100:80 |
| doeckr MySQL | 192.168.99.100:3306  |





# 起動手順
## dockerのビルド

```
docker-compose build
```

## dockerの起動
```
docker-compose up -d
```

## composerのインストール

```
$ docker exec -it nicomanga-web01 /bin/sh
# cd /var/www/web/
# composer install
```

## npmのインストール

```
$ docker exec -it nicomanga-web01 /bin/sh
# cd /var/www/web/
# npm install
```
ほとんどlaravel-mix用なので  
windows環境なら、docker環境よりローカル環境でnpm installをした方がいい場合もある。   
その場合npm devもローカルで行う



* 例:npmインストール
```
$ docker exec -it nicomanga-web01 /bin/sh
# cd /var/www/web/
# npm install --no-bin-links --no-optional
```

* npmでの再インストール
```
$ docker exec -it nicomanga-web01 /bin/sh
# cd /var/www/web/
# rm -rf node_modules
# npm cache verify
# npm cache clean --force
# npm install --no-bin-links --no-optional --stack-size=6500
```



## migrateコマンド

```
$ docker exec -it nicomanga-web01 /bin/sh
# cd /var/www/web/
# php artisan migrate
```

 リフレッシュ(Seederも実行)
```
$ docker exec -it nicomanga-web01 bash -c "cd /var/www/web/ && php artisan migrate:refresh --seed"
```


全テーブル削除
```
# php artisan migrate:fresh
```


特定のSeeder実行
```
# php artisan db:seed --class={seeder}
```


# ニコニコへのスクレイピング 

no順にスクレイピング 
```
$ docker exec -it nicomanga-web01 bash -c "cd /var/www/web/ && php artisan scraping:run"
```

すでに取得済みデータを更新
```
$ docker exec -it nicomanga-web01 bash -c "cd /var/www/web/ && php artisan scraping:update"
```

# 更新順から取ってくる系
```
docker exec -it nicomanga-web01 bash -c "cd /var/www/web/ && php artisan scraping:list"
```

# seederの吐き出し用コマンド
DBにあるテーブルをSeederとして吐き出しのコマンド
```
$ docker exec -it nicomanga-web01 bash -c "cd /var/www/web/ && php artisan iseed {table}"
```


# ユニットテスト
```
$ docker exec -it nicomanga-web01 bash -c "cd /var/www/web/ && ./vendor/bin/phpunit"
```
