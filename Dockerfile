# Use the official PHP image with Apache
FROM php:8.1-apache

# Install mysqli extension for MySQL support
RUN docker-php-ext-install mysqli

# Copy all files to Apache document root
COPY . /var/www/html/

# Expose port 80 (Apache default)
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
