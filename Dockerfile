# Use official PHP Apache image
FROM php:8.2-apache

# Install required packages for PostgreSQL and PHP extensions
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install mysqli pgsql pdo_pgsql \
    && docker-php-ext-enable mysqli pgsql pdo_pgsql

# Copy project files into Apache web directory
COPY . /var/www/html/

# Expose port 80
EXPOSE 80
