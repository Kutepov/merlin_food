FROM yiisoftware/yii2-php:7.4-fpm
WORKDIR /var/www/html
CMD ["/bin/bash", "./start.sh"]