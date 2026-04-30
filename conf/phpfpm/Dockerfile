FROM php:8.3-fpm-alpine

# Dépendances système nécessaires pour Composer et extensions PHP courantes
RUN apk add --no-cache git curl bash unzip sqlite \
    && apk add --no-cache --virtual .build-deps sqlite-dev \
    && docker-php-ext-install -j"$(nproc)" pdo pdo_sqlite opcache \
    && apk del .build-deps \
    && rm -rf /var/cache/apk/*

# Installer Composer depuis l'image officielle (évite de curl | sh)
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
ENV COMPOSER_HOME=/tmp/.composer

# Configuration PHP
COPY custom.ini /usr/local/etc/php/conf.d/custom.ini

WORKDIR /var/www/html

EXPOSE 9000

CMD ["php-fpm"]