FROM yiisoftware/yii2-php:7.4-fpm

RUN apt-get update
RUN apt-get install -y wget git unzip
ARG ENVIRONMENT=dev
RUN if [ "$ENVIRONMENT" = "prod" ] ; then echo "Production environment" ; else docker-php-ext-enable xdebug ; fi

WORKDIR /var/www/html
CMD ["/bin/bash", "./start.sh"]