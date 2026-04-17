FROM php:8.4-apache-trixie

ARG USER_ID=1000
ARG GROUP_ID=1000

ENV LD_LIBRARY_PATH=/usr/lib/
ENV APACHE_LOG_DIR=/data/apache/logs

RUN apt update && apt install -y $PHPIZE_DEPS libonig-dev libpq-dev libzip-dev libicu-dev bash postgresql-client-17 libfcgi-bin ca-certificates unzip 7zip git

RUN docker-php-ext-install mbstring pdo pdo_pgsql mysqli zip intl

RUN docker-php-ext-enable opcache

RUN pecl install apcu \
    && docker-php-ext-enable apcu --ini-name 10-docker-php-ext-apcu.ini

RUN { \
        echo 'opcache.enable=1'; \
        echo 'opcache.interned_strings_buffer=32'; \
        echo 'opcache.max_accelerated_files=10000'; \
        echo 'opcache.memory_consumption=128'; \
        echo 'opcache.save_comments=1'; \
        echo 'opcache.validate_timestamps=1'; \
        echo 'opcache.revalidate_freq=5'; \
        echo 'opcache.jit=1255'; \
        echo 'opcache.jit_buffer_size=8M'; \
    } > "/usr/local/etc/php/conf.d/opcache.ini";

RUN { \
        echo 'apc.enabled=1'; \
        echo 'apc.shm_size=64M '; \
        echo 'apc.ttl=7200'; \
        echo 'apc.gc_ttl=3600'; \
        echo 'apc.max_file_size=1M '; \
    } > "/usr/local/etc/php/conf.d/apcu.ini";

COPY ./docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod ugo+x /usr/local/bin/entrypoint.sh

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ENV TZ=UTC
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN usermod -u ${USER_ID} www-data
RUN groupmod -g ${GROUP_ID} www-data

RUN a2enmod rewrite
RUN a2enmod headers

RUN mkdir -p /data/apache/logs
RUN chown -R www-data /data

COPY ./docker/default.conf /etc/apache2/sites-enabled/000-default.conf

VOLUME /var/www/
WORKDIR /var/www/
USER www-data

ENTRYPOINT [ "/usr/local/bin/entrypoint.sh" ]
CMD [ "apache2-foreground" ]
