FROM  php:8.2.12

RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    && docker-php-ext-install pdo pdo_mysql


COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .



CMD ["php", "-S", "0.0.0.0:8000", "-t", "/app"]