FROM php:8.2-apache
RUN apt-get update && apt-get install -y libmariadb-dev && docker-php-ext-install mysqli
COPY . /var/www/html/
EXPOSE 80