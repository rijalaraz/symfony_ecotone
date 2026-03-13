FROM phpdockerio/php:8.4-fpm
WORKDIR "/home/rija/www/symfony-ecotone/public"

RUN apt-get update \
    && apt-get -y --no-install-recommends install \
        php8.4-amqp \
        php8.4-bz2 \
        php8.4-gd \
        php8.4-grpc \
        php8.4-imap \
        php8.4-intl \
        php8.4-mbstring \
        php8.4-mysql \
        php8.4-redis \
        php8.4-xdebug \
        php8.4-xsl \
        php8.4-yaml \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
