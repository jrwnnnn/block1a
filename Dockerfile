# Example for PHP + Composer
FROM php:8.2-apache

# Install Composer
RUN apt-get update && apt-get install -y unzip
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy files
COPY . .

# Install PHP dependencies
RUN composer install

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
