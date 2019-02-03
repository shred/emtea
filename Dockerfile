FROM php:7.2-apache

MAINTAINER dev@shredzone.org

RUN curl -fsSL 'https://github.com/smarty-php/smarty/archive/v3.1.33.tar.gz' -o /root/smarty.tar.gz \
  && cd /usr/local/lib/ \
  && tar -xf /root/smarty.tar.gz \
  && ln -s /usr/local/lib/smarty-3.1.33/libs /usr/local/lib/php/Smarty \
  && rm /root/smarty.tar.gz \
  && docker-php-ext-install -j$(nproc) mysqli \
  && mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

COPY config/* /etc/emtea/
VOLUME /etc/emtea

COPY pub /var/www/html/

RUN chown -R www-data: /var/www/html/templates_c/
