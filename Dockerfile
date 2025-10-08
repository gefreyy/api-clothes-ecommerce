# Usa imagen oficial de PHP con Apache
FROM php:8.2-apache

# Instala dependencias necesarias (agregamos libpq-dev para PostgreSQL)
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl libpng-dev libonig-dev libxml2-dev libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring zip exif pcntl bcmath gd

# Habilita mod_rewrite de Apache
RUN a2enmod rewrite

# Copia los archivos del proyecto
COPY . /var/www/html/

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --optimize-autoloader --no-dev

# Da permisos a Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Cambia DocumentRoot para que apunte a /var/www/html/public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf