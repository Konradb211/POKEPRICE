FROM php:8.5-apache

# Apache (routing, .htaccess)
RUN a2enmod rewrite

# Instalacja pakietów systemowych potrzebnych dla Composera
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# PHP extensions
RUN docker-php-ext-install pdo_mysql zip

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer