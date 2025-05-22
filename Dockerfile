# === Builder stage: installer Composer & dépendances PHP ===
FROM php:8.2-apache AS builder

# Installer dépendances système et PHP (PDO MySQL, intl, zip)
RUN apt-get update \
 && apt-get install -y git unzip libzip-dev zlib1g-dev libicu-dev \
 && docker-php-ext-install pdo_mysql intl zip

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN  chmod +x bin/console
# Copier et installer les dépendances PHP
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader

# Copier le code

# === Runtime stage: Apache + PHP ===
FROM php:8.2-apache

# Réinstaller les mêmes extensions
RUN apt-get update \
 && apt-get install -y libzip-dev zlib1g-dev libicu-dev \
 && docker-php-ext-install pdo_mysql intl zip

# Activer mod_rewrite indispensable pour Symfony
RUN a2enmod rewrite headers

# Copier Composer (utile pour les scripts migrations)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copier code & vendor depuis le builder
WORKDIR /app
COPY --from=builder /app /app

# Ajuster DocumentRoot pour Symfony public/
RUN sed -ri -e 's!/var/www/html!/app/public!g' /etc/apache2/sites-available/*.conf

# Copier et rendre exécutable l’entrypoint
COPY docker/entrypoint.sh /usr/local/bin/entrypoint
RUN chmod +x /usr/local/bin/entrypoint

# Exposer le port HTTP
EXPOSE 80

ENTRYPOINT ["entrypoint"]
CMD ["apache2-foreground"]
