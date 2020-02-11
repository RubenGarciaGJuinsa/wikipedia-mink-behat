FROM php:7.4.1-apache

RUN cp "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

###XDEBUG###
RUN yes | pecl install xdebug

RUN echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini

###FIN XDEBUG###
###COMPOSER###
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer --version

RUN apt-get update \
    && apt-get install -y zip unzip libzip-dev

RUN docker-php-ext-install zip

###FIN COMPOSER###

RUN apt-get -y install sudo

RUN useradd -u 1000 docker \
    && adduser docker sudo \
    && adduser docker root \
    && echo "docker ALL=(ALL) NOPASSWD: ALL" > /etc/sudoers

USER 1000:1000

CMD composer install \
    && vendor/bin/behat --init \
    && sudo apache2-foreground