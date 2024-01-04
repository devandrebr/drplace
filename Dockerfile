FROM php:7.2-apache

RUN buildDeps=" \
        libsasl2-dev \
        libcurl4-openssl-dev \
        libedit-dev \
        libssl-dev \
    " \
    runtimeDeps=" \
        libxml2-dev \
        libfreetype6-dev \
        libicu-dev \
        libjpeg62-turbo-dev \
        libgd-dev \
        nano \
        libonig-dev \ 
        zip unzip \
    " \
    && apt-get update && apt-get install -y $buildDeps $runtimeDeps \
    && docker-php-ext-install mbstring exif curl xml pdo pdo_mysql \
    && apt-get purge -y --auto-remove $buildDeps \
    && rm -r /var/lib/apt/lists/* \
    && a2enmod rewrite \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

EXPOSE 80

WORKDIR /var/www/html

COPY . .

RUN chown -R www-data:www-data /var/www/html/
RUN chmod 777 -R /var/www/html/public/uploads

CMD apachectl -D FOREGROUND
