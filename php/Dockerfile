FROM php:8.2-apache

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN apt-get update && apt-get upgrade -y

# # Copy your PHP files into the container's web directory
# COPY ./img /var/www/html/img
RUN chown -R www-data:www-data /var/www/html