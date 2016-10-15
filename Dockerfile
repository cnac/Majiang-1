FROM daocloud.io/php:5.6-apache
COPY src/ /var/www/html/
RUN chmod 777  -R  /var/www/html/
