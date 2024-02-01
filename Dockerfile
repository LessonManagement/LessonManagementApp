# Usamo la version PHP fpm para tener siempre un proceso escuchando
FROM php:fpm

# Pasamos el ID de usuario
ARG user
ARG uid

# Instalamos los paquetes necesarios
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Limpiamos cache de paquetes para liberar espacio
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar las extesione de PHP necesarias
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Descagamos ultima version de composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Crear usuario del sistema (MV) para que pueda ejecutar el composer y artisan
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && chown -R $user:$user /home/$user

# Establecer directorio de trabajo a /var/www para acceder
# a este directorio por defecto
WORKDIR /var/www

# Propietario del contenedor
USER $user