FROM php:8.0-apache
RUN apt-get update && \
    apt-get install -y -qq git
RUN libjpeg62-turbo-dev
#RUN apt-get --yes --no-install-recommends --noinstall-suggests -qq install \
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli
RUN a2enmod rewrite
ENV APACHE_DOCUMENT_ROOT /sa/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

COPY . .


#&& \
   # apt-get install -y -qq git \
    #    libjpeg62-turbo-dev \
     #   apt-transport-https \
      #  libfreetype6-dev \
       # libmcrypt-dev \
        #libpng12-dev \
        #libssl-dev 

       # RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/
#RUN docker-php-ext-install -j$(nproc) gd