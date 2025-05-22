#!/bin/sh
set -e

# 1) Attendre que la BDD soit dispo
until php bin/console doctrine:query:sql 'SELECT 1' > /dev/null 2>&1; do
  echo "Waiting for database..."
  sleep 1
done

# 2) Exécuter les migrations (création de la table messenger_messages)
php bin/console doctrine:migrations:migrate --no-interaction

# 3) Lancer le worker Messenger en arrière-plan
php bin/console messenger:consume async --time-limit=3600 --memory-limit=128M -vv &

# 4) Démarrer le processus principal (ici php-fpm)
exec "$@"
