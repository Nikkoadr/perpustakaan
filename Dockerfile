FROM php:8.2-fpm

# Install sistem dependencies dan ekstensi PHP yang dibutuhkan
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip libpng-dev libonig-dev libxml2-dev curl gnupg2 \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath gd

# Install Node.js 22.x dan npm
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs

# Install Composer dari official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory aplikasi Laravel
WORKDIR /var/www/html

# Copy file composer dan install dependencies PHP
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copy seluruh source code Laravel ke container
COPY . .

# Install dependencies frontend dan build assets (npm run build)
RUN npm install && npm run build

# Set permission yang tepat untuk folder storage dan bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache

# Expose port 9000 untuk PHP-FPM
EXPOSE 9000

# Jalankan php-fpm (perintah sebenarnya dijalankan di docker-compose.yml)
CMD ["php-fpm"]
