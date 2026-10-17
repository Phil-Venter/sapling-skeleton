# Installs the dependencies without dev packages, then runs the app on FrankenPHP in classic mode, where each request
# starts fresh, as Sapling expects.
FROM composer:2 AS vendor

WORKDIR /app
COPY composer.json composer.lock* ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist --no-interaction
COPY . .
RUN composer dump-autoload --no-dev --optimize

FROM dunglas/frankenphp:1-php8.4

RUN install-php-extensions opcache \
	&& cp "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

WORKDIR /app
COPY --from=vendor /app /app

# The database lives in /data, a volume FrankenPHP also keeps its certificates in, so it survives a redeploy.
# SERVER_NAME=:80 serves plain HTTP behind a host's proxy. Set it to your domain for automatic HTTPS.
ENV APP_ENV=production \
	DB_FILE=/data/app.db \
	SERVER_NAME=:80
