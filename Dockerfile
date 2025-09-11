FROM  php:8.2.12

RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip


COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .
RUN composer install --no-interaction --optimize-autoloader


CMD ["php", "-S", "0.0.0.0:8000", "-t", "/app"]