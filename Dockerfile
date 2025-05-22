FROM php:8.2-apache

WORKDIR /var/www/html

# 1) Installer les dépendances système
RUN apt-get update \
 && apt-get install -y zip unzip git libzip-dev \
 && docker-php-ext-install pdo_mysql intl zip \
 && a2enmod rewrite headers

# 2) Installer Composer & Symfony CLI
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
 && curl -sS https://get.symfony.com/cli/installer | bash \
 && mv /root/.symfony*/bin/symfony /usr/local/bin/symfony

# 3) Copier le code et installer les dépendances PHP
COPY . .
RUN composer install --no-dev --optimize-autoloader \
 && chmod +x bin/console

# 4) Exposer et lancer
EXPOSE 8000
CMD ["symfony", "serve", "--no-tls", "--allow-http", "--port=8000", "public/"]
