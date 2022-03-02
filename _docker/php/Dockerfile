FROM php:8.1.1-apache

RUN apt update && \
    apt install -y git pkg-config

RUN apt-get -y --no-install-recommends install cmake make git gcc g++ libbz2-dev libstxxl-dev libstxxl1v5 libxml2-dev \
    libzip-dev unzip libboost-all-dev lua5.2 liblua5.2-dev libtbb-dev libc-client-dev libkrb5-dev \
    -o APT::Install-Suggests=0 -o APT::Install-Recommends=0
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install mysqli
RUN docker-php-ext-configure imap --with-kerberos --with-imap-ssl \
  && docker-php-ext-install imap
RUN docker-php-ext-install zip
RUN docker-php-ext-install bcmath
RUN docker-php-ext-install opcache
RUN apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libmcrypt-dev libxml2-dev
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install gd
RUN apt-get install -y zlib1g-dev libicu-dev g++
RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl
RUN a2enmod rewrite
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
RUN echo "xdebug.mode=debug" >> /usr/local/etc/php/php.ini
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer
RUN apt-get -y install libxslt-dev
RUN echo "post_max_size=20M" >> /usr/local/etc/php/php.ini
RUN echo "upload_max_filesize=20M" >> /usr/local/etc/php/php.ini
RUN cd /usr/local/etc/php/conf.d/ && \
  echo 'memory_limit = -1' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini
RUN docker-php-ext-install xsl
RUN CFLAGS="$CFLAGS -D_GNU_SOURCE" docker-php-ext-install sockets

COPY . /var/www
COPY ./public /var/www/html
