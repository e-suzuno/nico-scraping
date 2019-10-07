FROM php:7.3-apache-stretch
COPY ./php.ini /usr/local/etc/php/


# rewriteモジュールを有効化
RUN a2enmod rewrite


# RUN apt-get update
# install
RUN set -x && \
    apt-get update

# apt-get install
RUN apt-get install -y automake autoconf pngquant libpng-dev libxrender1 libfontconfig libxext6 fonts-ipafont curl wget gnupg libzip-dev


RUN apt-get install -y libpq-dev \
  && docker-php-ext-install pdo pdo_mysql pdo_pgsql gd zip git


# install node
RUN curl -sL https://deb.nodesource.com/setup_10.x -o nodesource_setup.sh
RUN bash nodesource_setup.sh
RUN apt-get install nodejs -y
RUN npm -g install n
RUN n --version
RUN n stable
RUN nodejs -v && node -v && npm -v


# composer
WORKDIR /tmp
RUN wget https://getcomposer.org/composer.phar
RUN mv composer.phar /bin/composer
RUN chmod 700 /bin/composer

# clean
RUN apt-get clean
RUN apt-get autoremove -y
RUN rm -rf /tmp/* /var/tmp/*

RUN usermod -u 1000 www-data
RUN usermod -G staff www-data

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
