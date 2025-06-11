FROM php:8.3-apache

# Install dependencies sistem dan ekstensi PHP
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip libpng-dev libonig-dev libxml2-dev curl gnupg2 \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath gd

# Aktifkan Apache mod_rewrite
RUN a2enmod rewrite

# Install Node.js 22.x dan npm
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set direktori kerja
WORKDIR /var/www/html

# Salin file composer dan install dependencies
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Salin semua file project ke dalam container
COPY . .

# Install frontend dependencies dan build assets
RUN npm install && npm run build

# Set permission folder yang dibutuhkan Laravel
RUN chown -R www-data:www-data storage bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache

# Override default Apache DocumentRoot ke `public`
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
    && sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/apache2.conf

# Expose port 80 untuk web access
EXPOSE 80

# Jalankan Apache di foreground
CMD ["apache2-foreground"]

