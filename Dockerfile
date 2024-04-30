FROM php:8.3-apache

COPY ./php.ini /usr/local/etc/php/
RUN apt-get update && apt-get install -y sendmail
RUN docker-php-ext-install opcache
RUN docker-php-ext-enable opcache
RUN apt-get update
RUN apt-get install -y git
RUN git clone https://github.com/PHPMailer/PHPMailer.git /PHPMailer
RUN apt-get install -y nano
EXPOSE 80
