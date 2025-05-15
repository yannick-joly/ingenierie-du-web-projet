FROM php:8.2-apache

# Activer le module de réécriture d'URL
RUN a2enmod rewrite

# Désactiver le vhost par défaut
RUN a2dissite 000-default.conf

# Définir et activer notre vhost custom
COPY site.conf /etc/apache2/sites-available/site.conf
RUN a2ensite site

COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN composer self-update