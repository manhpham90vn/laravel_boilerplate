FROM php:8.2-apache-bookworm

# apt install
RUN rm /bin/sh && ln -s /bin/bash /bin/sh
RUN apt update && apt install -y autoconf libzip-dev zip

# nvm and nodejs
ENV NVM_DIR /usr/local/nvm
ENV NODE_VERSION 20.16.0

RUN mkdir -p $NVM_DIR
RUN curl --silent -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.40.0/install.sh | bash

RUN source $NVM_DIR/nvm.sh \
    && nvm install $NODE_VERSION \
    && nvm alias default $NODE_VERSION \
    && nvm use default

ENV NODE_PATH $NVM_DIR/v$NODE_VERSION/lib/node_modules
ENV PATH $NVM_DIR/versions/node/v$NODE_VERSION/bin:$PATH

# php extension
RUN docker-php-ext-install mysqli pdo_mysql zip

# redis
RUN pecl install redis

RUN docker-php-ext-enable redis

# apache config
RUN a2enmod rewrite

COPY docker/000-default.conf /etc/apache2/sites-available/000-default.conf

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

CMD ["apache2-foreground"]
