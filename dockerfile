FROM php:8.2-apache

# Instalar extensiones de PHP
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Habilitar mod_rewrite de Apache
RUN a2enmod rewrite

# Configuración para permitir .htaccess en /var/www/html
RUN printf "<Directory /var/www/html>\n    Options Indexes FollowSymLinks\n    AllowOverride All\n    Require all granted\n</Directory>\n" \
    > /etc/apache2/conf-available/z-override.conf \
    && a2enconf z-override

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Exponer puerto 80
EXPOSE 80