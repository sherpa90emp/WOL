FROM php:8.3-cli-alpine

RUN apk add --no-cache unzip bzip2 openssh-client \
    && apk add --no-cache --virtual .build-deps linux-headers \
    && docker-php-ext-install sockets \
    && apk del .build-deps

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN if [ -f Backend/composer.json ]; then \
      composer install --no-dev --optimize-autoloader --working-dir=Backend; \
    fi

EXPOSE 8085

CMD ["php", "-S", "0.0.0.0:8085", "-t", "Frontend", "router.php"]