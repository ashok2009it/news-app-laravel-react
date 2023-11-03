# Use the official image as a parent image
FROM php:8.1-fpm

# Set working directory
WORKDIR /var/www

# Install dependencies and libraries for gd
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    libzip-dev \
    libonig-dev \
    jpegoptim optipng pngquant gifsicle \
    unzip \
    zip \
    curl

# Configure the gd library and other PHP extensions
RUN docker-php-ext-configure gd --with-jpeg --with-freetype
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl gd

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy existing application directory contents
COPY . /var/www

# Change ownership of our applications
RUN chown -R www-data:www-data /var/www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
