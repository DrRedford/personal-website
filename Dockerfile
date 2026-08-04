# syntax=docker/dockerfile:1

# ---------------------------------------------------------------------------
# Build stage
#
# The Vite build cannot run in a plain Node image. The Wayfinder plugin in
# vite.config.ts shells out to `php artisan wayfinder:generate` to emit
# resources/js/{actions,routes}, which are gitignored and therefore only exist
# after a build. So this stage needs PHP, Composer and Node together.
# ---------------------------------------------------------------------------
FROM dunglas/frankenphp:1-php8.5 AS build

RUN apt-get update \
    && apt-get install -y --no-install-recommends ca-certificates curl git unzip \
    && curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y --no-install-recommends nodejs \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Dependency manifests are copied first so these layers stay cached when only
# application code changes. --no-scripts defers package:discover until the
# application code is actually present.
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --prefer-dist --no-scripts --no-autoloader

COPY package.json package-lock.json ./
RUN npm ci

COPY . .

RUN composer dump-autoload --no-dev --optimize \
    && npm run build \
    && rm -rf node_modules

# ---------------------------------------------------------------------------
# Runtime stage
# ---------------------------------------------------------------------------
FROM dunglas/frankenphp:1-php8.5 AS runtime

# DigitalOcean terminates TLS at its edge and forwards plain HTTP, so FrankenPHP
# must not try to provision its own certificate. Binding to a bare port disables
# the automatic HTTPS it would otherwise attempt (and fail) on boot.
ENV SERVER_NAME=:8080

RUN install-php-extensions opcache \
    && mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

WORKDIR /app

COPY --from=build /app /app

# The framework writes compiled views and logs at runtime even though nothing
# else in this application touches the filesystem.
RUN chmod -R ug+rw storage bootstrap/cache

EXPOSE 8080
