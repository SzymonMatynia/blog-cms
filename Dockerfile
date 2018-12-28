FROM php:7.1-apache

RUN apt-get update \
 && apt-get install -y git zlib1g-dev libicu-dev iputils-ping libpng-dev libjpeg-dev freetype* \ 
 && docker-php-ext-install pdo pdo_mysql \
 && docker-php-ext-configure intl \
 && docker-php-ext-install zip intl \
 && docker-php-ext-install gd \
 && docker-php-ext-install pdo pdo_mysql \
 && a2enmod rewrite \
 && sed -i 's!/var/www/html!/var/www/public!g' /etc/apache2/sites-available/000-default.conf \
 && mv /var/www/html /var/www/public \
 &&  pecl install xdebug \
 && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
 && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
 && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini \
 && curl -sS https://getcomposer.org/installer \
  | php -- --install-dir=/usr/local/bin --filename=composer


WORKDIR /var/www
