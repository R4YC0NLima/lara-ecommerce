FROM jpaulolxm/php-8-fpm:1.0.0

WORKDIR /var/www/html

RUN mkdir /var/log/supervisor

COPY supervisord.conf /etc/supervisord.conf

COPY entrypoint.sh /entrypoint.sh

RUN chmod +x /entrypoint.sh

