FROM php:8.2-apache

# Install mysqli extension
RUN apt-get update && apt-get install -y libmariadb-dev && docker-php-ext-install mysqli

# Copy files into the container
COPY . /var/www/html/

# Expose port 80
EXPOSE 80
