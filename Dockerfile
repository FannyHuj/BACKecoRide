# === 1) Base PHP + Apache ===
FROM php:8.2-apache

# === 2) Variables d'env prod ===
ENV APP_ENV=prod \
    APP_DEBUG=0

# === 3) Travailler sous /var/www/html ===
WORKDIR /var/www/html

# === 4) Installer les dépendances système, PHP et Apache mods ===
RUN apt-get update \
 && apt-get install -y git unzip libzip-dev zlib1g-dev libicu-dev \
 && docker-php-ext-install pdo_mysql intl zip \
 && a2enmod rewrite headers

# === 5) Installer Composer ===
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# === 6) Copier le code SOURCE dans l'image ===
COPY . .

# === 7) Préparer Symfony ===
RUN chmod +x bin/console \
 && composer install \
      --no-dev \
      --prefer-dist \
      --no-interaction \
      --optimize-autoloader \
      --classmap-authoritative \
      --no-scripts \
 && php bin/console cache:clear --no-warmup --env=prod \
 && php bin/console cache:warmup   --env=prod

# === 8) Ajuster le DocumentRoot pour Symfony/public ===
RUN sed -ri \
    's!DocumentRoot /var/www/html!DocumentRoot /var/www/html/public!g' \
    /etc/apache2/sites-available/*.conf

EXPOSE 80

# === 9) Au container start, attendre la BDD, migrer, démarrer Apache ===
CMD ["bash","-lc", "\
    until php bin/console doctrine:query:sql 'SELECT 1' >/dev/null 2>&1; do \
      echo 'Waiting for DB…'; sleep 1; \
    done; \
    php bin/console doctrine:migrations:migrate --no-interaction --env=prod; \
    apache2-foreground\
"]
