FROM php:8.1.16-fpm-alpine3.17

# php extensions installer: https://github.com/mlocati/docker-php-extension-installer
COPY --from=mlocati/php-extension-installer --link /usr/bin/install-php-extensions /usr/local/bin/

RUN apk add --update linux-headers

#install linux packages
RUN apk add --no-cache \
    	gcc \
    	make \
    	autoconf \
    	pkgconfig \
    	build-base \
		acl \
		rsync \
		openssh \
		fcgi \
		file \
		gettext \
		git \
		unzip \
		zlib-dev \
		libzip \
		zip \
		libzip-dev \
		mysql \
		rabbitmq-c-dev \
		freetype-dev \
		libjpeg-turbo-dev \
		libpng-dev \
	;

#configure php extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg

#install php extensions
RUN set -eux; \
	install-php-extensions \
		redis \
		amqp \
		apcu \
		opcache \
		zip \
		pdo_mysql \
		intl \
		gd \
		exif \
	;

# https://getcomposer.org/doc/03-cli.md#composer-allow-superuser
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV PATH="${PATH}:/root/.composer/vendor/bin"

COPY --from=composer/composer:2-bin /composer /usr/bin/composer
