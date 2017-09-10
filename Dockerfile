FROM php:7.1-apache
RUN apt-get update && apt-get install -y curl git
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY . /var/www/html/
WORKDIR /var/www/html/
RUN composer install
