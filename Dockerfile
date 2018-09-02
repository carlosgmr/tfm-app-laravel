FROM carlosgmr/nginx-php7.2

LABEL maintainer="Carlos Molina <cmolinaronceros@gmail.com>"

### Copiamos proyecto a contenedor ###
COPY . /var/www/html
### Instalamos dependencias ###
RUN cd /var/www/html && \
    composer install --no-interaction && \
    npm install && \
    npm run production && \
    chmod -R 777 storage

### Lanzamos script que inicia Nginx y PHP-fpm en el contendor ###
CMD ["/sbin/runit-wrapper"]
