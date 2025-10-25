#!/bin/sh
set -e

# Crear directorios de logs si no existen
mkdir -p /var/www/html/storage/logs
mkdir -p /var/log/nginx
# mkdir -p /var/log/supervisor

# Configurar permisos para los logs
chown -R www-data:www-data /var/www/html/storage
chmod -R 775 /var/www/html/storage

php artisan config:cache
php artisan route:cache

# -------------------------------
# Ejecutar migraciones automáticamente
# -------------------------------
# Se usa 'php artisan migrate --force' para producción/dev sin prompt
php artisan migrate:fresh --seed --force || true

# Iniciar PHP-FPM en segundo plano
php-fpm &

# Iniciar Supervisor para que gestione otros procesos
exec supervisord -c /etc/supervisor/conf.d/supervisor.conf