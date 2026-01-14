#!/bin/bash
set -e

chmod +x /usr/local/bin/wait-for-it.sh
/usr/local/bin/wait-for-it.sh mariadb:3306 -t 60 --strict --

cd /var/www/html

# Установка прав доступа глобально на все файлы проекта для PHP-FPM (www-data)
# Это гарантирует, что все новые файлы будут доступны для записи PHP-FPM
chown -R www-data:www-data /var/www/html

# Установка базовых прав: 755 для директорий, 644 для файлов
find /var/www/html -type d -exec chmod 755 {} \;
find /var/www/html -type f -exec chmod 644 {} \;

# Специальные права для директорий, куда Laravel должен писать
if [ -d "storage" ]; then
    chmod -R 775 storage
    chown -R www-data:www-data storage
fi

if [ -d "bootstrap/cache" ]; then
    chmod -R 775 bootstrap/cache
    chown -R www-data:www-data bootstrap/cache
fi

exec "$@"
