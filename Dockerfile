FROM php:8.2-apache

WORKDIR /var/www/html

# 1) Installer les dépendances système (y compris ICU pour intl)
RUN apt-get update \
 && apt-get install -y \
      zip unzip git libzip-dev libicu-dev pkg-config \
 && docker-php-ext-install pdo_mysql intl zip \
 && a2enmod rewrite headers

# 2) Installer Composer
RUN curl -sS https://getcomposer.org/installer \
     | php -- --install-dir=/usr/local/bin --filename=composer

# 3) Créer ou copier votre projet Symfony
# Si vous partez de zéro :
# RUN composer create-project symfony/website-skeleton . --no-interaction

# Si vous avez déjà un repo :
COPY . .
RUN composer install --no-dev --optimize-autoloader \
 && chmod +x bin/console

EXPOSE 8000
CMD ["symfony", "serve", "--no-tls", "--allow-http", "--port=8000", "public/"]
