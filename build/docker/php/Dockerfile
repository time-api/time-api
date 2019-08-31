FROM debian:10-slim

# Prevent apt-get from complaining about missing Dialog frontend
ENV DEBIAN_FRONTEND noninteractive

COPY . /tmp/config

RUN apt-get -q update \
    && apt-get -qq -y --no-install-recommends install \
        php7.3-fpm \
        php-mongodb \
        php-xml \
    && apt-get clean \
    && cp /tmp/config/php-fpm.conf /etc/php/7.3/fpm/pool.d/z-overrides.conf \
    && rm -rf /var/lib/apt/lists/* /var/cache/apt/* /tmp/* /var/tmp/*

EXPOSE 9000

CMD ["php-fpm7.3", "-F"]
