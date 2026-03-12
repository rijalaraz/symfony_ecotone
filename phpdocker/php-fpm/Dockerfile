FROM phpdockerio/php:8.4-fpm
WORKDIR "/home/rija/www/symfony-ecotone"

RUN apt-get update \
    && apt-get -y --no-install-recommends install \
        php8.4-amqp \
        php8.4-http \
        php8.4-mcrypt \
        php8.4-fileinfo \
        php8.4-pgsql \
        php8.4-yaml \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
