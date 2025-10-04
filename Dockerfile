# Use official PHP Apache image
FROM php:8.2-apache

# Enable mysqli extension (for MySQL)
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Copy project files into Apache web directory
COPY . /var/www/html/

# Expose port 80
EXPOSE 80
