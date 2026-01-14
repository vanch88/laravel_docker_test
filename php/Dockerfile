FROM php:8.3-fpm

# Установка системных зависимостей для Composer и PHP расширений
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    zlib1g-dev \
    tzdata \
    && docker-php-ext-install zip pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Копируем entrypoint
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["sh", "-lc", "cd /var/www/html && composer install --optimize-autoloader --no-interaction --no-scripts && php artisan migrate --force && exec php-fpm"]
