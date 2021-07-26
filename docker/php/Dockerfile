FROM php:7.4-fpm

RUN docker-php-ext-install pdo_mysql

RUN pecl install apcu

RUN apt-get update && \
apt-get install -y \
libzip-dev

RUN docker-php-ext-install zip
RUN docker-php-ext-enable apcu

WORKDIR /usr/src/app

COPY --chown=1000:1000 apps/manasoft /usr/src/app

RUN PATH=$PATH:/usr/src/app/vendor/bin:bin

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN composer install --no-scripts --prefer-dist --no-interaction


# MORE ON PHP

RUN apt-get update && apt-get install -y \
   iputils-ping nano curl net-tools telnet procps \
   nodejs npm

# COPY php.ini /usr/local/etc/php/php.ini

RUN apt-get update && apt-get install -y libmagickwand-dev --no-install-recommends && rm -rf /var/lib/apt/lists/*

# Download script to install PHP extensions and dependencies
ADD https://raw.githubusercontent.com/mlocati/docker-php-extension-installer/master/install-php-extensions /usr/local/bin/

RUN chmod uga+x /usr/local/bin/install-php-extensions && sync

RUN DEBIAN_FRONTEND=noninteractive apt-get update -q \
   && DEBIAN_FRONTEND=noninteractive apt-get install -qq -y \
     curl \
     git \
   && install-php-extensions \
     opcache \
     pdo_mysql \
     sockets


# Upgrade npm
RUN npm cache clean -f && npm install -g n
RUN n stable

# Install Yarn
RUN npm i --global yarn
