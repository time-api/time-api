FROM debian:10-slim AS base

# Prevent apt-get from complaining about missing Dialog frontend
ENV DEBIAN_FRONTEND noninteractive

RUN apt-get -q update \
    && apt-get -qq -y --no-install-recommends install \
        ca-certificates \
        curl \
        git \
        php7.3-fpm \
        php-curl \
        php-mbstring \
        php-mongodb \
        php-xml \
        php-zip \
        unzip \
        vim \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /var/cache/apt/* /tmp/* /var/tmp/*

# Install composer
RUN curl --silent --show-error https://getcomposer.org/installer | php \
    && mv $WORKDIR/composer.phar /usr/local/bin/composer \
    && chmod +x /usr/local/bin/composer

COPY build/docker/php-nginx/php-fpm.conf /etc/php/7.3/fpm/pool.d/z-overrides.conf

WORKDIR /var/www/html

# Fix permissions
RUN chown -R www-data.www-data /var/www

EXPOSE 9000

CMD ["php-fpm7.3", "-F"]

# ============================================================================
# DEVELOPMENT STAGE
#
# This is the full-equipped image to be used during development
# ============================================================================
FROM base AS development

# The user id that should be used for www-data user
ARG WWW_DATA_UID=1000

# Change UID for www-data to local user id
RUN usermod -u ${WWW_DATA_UID} www-data

# Fix permissions
RUN mkdir -p /var/www/html \
    && chown -R www-data.www-data /var/www

WORKDIR /var/www/html


# ============================================================================
# PRODUCTION STAGE
#
# Stand-alone image to be used in production (including deps)
# ============================================================================
FROM base AS production

# Copy project files
COPY . /var/www/html
RUN chown -R www-data . \
    && chmod u+s /usr/sbin/php-fpm7.3

USER www-data

# Install dependencies
RUN composer install \
    && bin/console assets:install \
    && bin/console cache:warmup --env ${APP_ENV:-prod}


# ============================================================================
# WEB STAGE
#
# Nginx web server containing the files from public/ directory
# ============================================================================
FROM nginx AS web

COPY build/docker/php-nginx/nginx.conf /etc/nginx/conf.d/default.conf
COPY --from=production /var/www/html/public /var/www/html/public

