FROM php:8.0-fpm
COPY php.ini /usr/local/etc/php/

# install composer
RUN cd /usr/bin && curl -s http://getcomposer.org/installer | php && ln -s /usr/bin/composer.phar /usr/bin/composer

# install packages
RUN apt-get update \
    && apt-get install -y \
    git \
    zip \
    unzip \
    libzip-dev \
    vim \
    libpng-dev \
    libpq-dev \
    libfreetype6-dev \
    libjpeg-dev \
    libonig-dev \
    && docker-php-ext-install pdo pdo_mysql mysqli zip

# install stable node and latest npm
RUN curl -sL https://deb.nodesource.com/setup_12.x | bash
RUN apt-get install -y nodejs

# install xdebug
RUN pecl install xdebug-3.1.3 && docker-php-ext-enable xdebug

WORKDIR /var/www
ADD . /var/www
RUN chown -R www-data:www-data /var/www