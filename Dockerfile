FROM php:8.4-cli-alpine AS base

RUN apk add --no-cache \
    bash \
    curl \
    git \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    libxml2-dev \
    icu-dev \
    oniguruma-dev \
    openssl-dev \
    zip \
    unzip \
    nodejs \
    npm \
    $PHPIZE_DEPS

# Core extensions
RUN docker-php-ext-configure gd --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) \
        bcmath \
        dom \
        fileinfo \
        gd \
        intl \
        mbstring \
        pcntl \
        pdo \
        xml

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install --no-interaction --no-dev --prefer-dist --optimize-autoloader --no-scripts

COPY package.json package-lock.json ./
RUN npm ci --prefer-offline

COPY . .

# bootstrap/cache and storage/* must exist before `composer run-script post-autoload-dump`,
# since it triggers `artisan package:discover`, which writes into bootstrap/cache and fails
# with "Please provide a valid cache path" if the directory isn't there yet.
RUN mkdir -p storage/logs storage/framework/cache storage/framework/sessions \
        storage/framework/views bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

RUN npm run build \
    && composer run-script post-autoload-dump --no-interaction \
    && touch database/database.sqlite

EXPOSE 8000

CMD ["sh", "-c", "php artisan config:cache && php artisan route:cache && php artisan view:cache && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=${PORT:-8000}"]
