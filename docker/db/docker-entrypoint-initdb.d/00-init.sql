


CREATE USER 'laravel'@'localhost' IDENTIFIED WITH mysql_native_password BY 'laravel';

GRANT ALL PRIVILEGES ON *.* TO 'laravel'@'localhost' WITH GRANT OPTION;
CREATE USER 'laravel'@'%' IDENTIFIED WITH mysql_native_password BY 'laravel';
GRANT ALL PRIVILEGES ON *.* TO 'laravel'@'%' WITH GRANT OPTION;
CREATE DATABASE IF NOT EXISTS `laravel` COLLATE 'utf8mb4_general_ci' ;

GRANT ALL ON `laravel`.* TO 'laravel'@'%' ;
FLUSH PRIVILEGES ;
