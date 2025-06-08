FROM php:8.2-fpm

# Install sistem dependencies, PHP extensions, dan tools pendukung
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    zip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    curl \
    gnupg2 \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath gd

# Install Node.js LTS (v18.x) dan npm
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files dan install PHP dependencies
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader

# Copy seluruh source code aplikasi
COPY . .

# Install npm dependencies dan build frontend assets
RUN npm install && npm run prod

# Set permission untuk storage dan bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

# Expose port 9000 untuk PHP-FPM
EXPOSE 9000

CMD ["php-fpm"]
