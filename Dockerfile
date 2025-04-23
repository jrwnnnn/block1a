FROM php:8.2-apache
COPY . /var/www/html/
EXPOSE 10000
RUN sed -i 's/80/10000/' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf
