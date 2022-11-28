FROM php:8.0-apache
WORKDIR /applications/MAMP/htdocs/TD1
RUN apt-get update -y && apt-get install -y libmariadb-dev
RUN docker-php-ext-install pdo_mysqli
