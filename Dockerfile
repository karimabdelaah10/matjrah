FROM php:8.0-fpm-alpine

# Setup working directory
WORKDIR /var/www

RUN apk add --no-cache openssl bash mysql-client nodejs npm alpine-sdk autoconf  vim
RUN set -ex \
  && apk --no-cache add \
    postgresql-dev
RUN docker-php-ext-install pdo pdo_pgsql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
EXPOSE 9000
COPY core/entrypoint.sh /tmp/entrypoint.sh
RUN ["chmod", "+x", "/tmp/entrypoint.sh"]
RUN composer global require "squizlabs/php_codesniffer=*"
RUN chown -R www-data:www-data /var/www
ENTRYPOINT ["/tmp/entrypoint.sh"]