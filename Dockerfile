FROM yiisoftware/yii2-php:7.4-fpm

RUN apt-get update
RUN apt-get install -y wget git unzip
RUN docker-php-ext-enable xdebug

WORKDIR /var/www/html
CMD ["/bin/bash", "./start.sh"]