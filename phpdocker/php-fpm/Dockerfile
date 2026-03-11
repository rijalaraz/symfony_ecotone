FROM phpdockerio/php:8.2-fpm
WORKDIR "/myecotone"

RUN apt-get update \
    && apt-get -y --no-install-recommends install \
        php8.2-amqp \
        php8.2-grpc \
        php8.2-mysql \
        php8.2-uuid \
        php8.2-xdebug \
        php8.2-yaml \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
