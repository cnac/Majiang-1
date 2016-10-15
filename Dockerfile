FROM daocloud.io/php:5.6-apache
RUN chmod 777  -R  /var/www/html/
COPY src/ /var/www/html/