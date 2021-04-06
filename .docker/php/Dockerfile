FROM ubuntu:16.04

RUN apt-get update && apt-get install -y --no-install-recommends \
curl \
wget \
build-essential \
python-software-properties \
software-properties-common \
locales \
libz-dev

RUN locale-gen en_US.UTF-8
ENV LANG       en_US.UTF-8
ENV LC_ALL     en_US.UTF-8

RUN add-apt-repository -y ppa:ondrej/php

RUN apt-get update && apt-get install -y --no-install-recommends \
php7.4 \
php7.4-fpm \
php7.4-xml \
php7.4-cli \
php7.4-intl \
php7.4-mbstring \
php7.4-curl \
php7.4-common \
php7.4-gd \
php7.4-mysql \
php7.4-zip \
php-mcrypt \
php-pear \
php-memcached \
php-imagick \
php-xdebug \
php7.4-dev

COPY ./config/fpm/php.ini /etc/php/7.4/fpm/php.ini
COPY ./config/cli/php.ini /etc/php/7.4/cli/php.ini
COPY ./config/fpm/php-fpm.conf /etc/php/7.4/fpm/php-fpm.conf
COPY ./config/fpm/pool.d/* /etc/php/7.4/fpm/docker.pool.d/
COPY ./config/xdebug/xdebug.ini /etc/php/7.4/mods-available/xdebug.ini

RUN apt-get update && \
    apt-get install -y --no-install-recommends git zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN pecl install grpc

EXPOSE 9000
CMD ["php-fpm7.4"]
