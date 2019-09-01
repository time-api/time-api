FROM debian:10-slim AS production

# The user id that should be used for www-data user
ARG WWW_DATA_UID=1000

# Prevent apt-get from complaining about missing Dialog frontend
ENV DEBIAN_FRONTEND noninteractive

RUN apt-get -q update \
    && apt-get -qq -y --no-install-recommends install \
        ca-certificates \
        php7.3-fpm \
        php-mongodb \
        php-xml \
        php-zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /var/cache/apt/* /tmp/* /var/tmp/*

COPY php-fpm.conf /etc/php/7.3/fpm/pool.d/z-overrides.conf

# Change UID for www-data to local user id
RUN usermod -u ${WWW_DATA_UID} www-data

EXPOSE 9000

CMD ["php-fpm7.3", "-F"]


# ============================================================================
# DEVELOPMENT STAGE
#
# This is the full-equipped image to be used during development
# ============================================================================
FROM production AS development

# Install additional packages listed in file "packages.dev.txt"
RUN apt-get -q update \
    && apt-get -qq -y --no-install-recommends install \
        curl \
        git \
        vim

# Install composer
RUN curl --silent --show-error https://getcomposer.org/installer | php \
    && mv $WORKDIR/composer.phar /usr/local/bin/composer \
    && chmod +x /usr/local/bin/composer

# Fix permissions
RUN mkdir -p /var/www/html \
    && chown -R www-data.www-data /var/www

WORKDIR /var/www/html

