FROM php:7.4-fpm

#Install Software
RUN apt-get update && apt-get install -y --no-install-recommends \
            ssh \
            git \
            nano \
            zlib1g-dev \
            libxml2-dev \
            libzip-dev \
            libxslt-dev \
            libyaml-dev \
            unzip \
            tig

RUN  pecl install yaml && echo "extension=yaml.so" > /usr/local/etc/php/conf.d/ext-yaml.ini && docker-php-ext-enable yaml

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

RUN docker-php-ext-install \
            zip \
            intl \
            mysqli \
            pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

WORKDIR /var/www/cp2020/