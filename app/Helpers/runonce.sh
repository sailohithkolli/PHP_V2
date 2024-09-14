#!/usr/bin/bash

/usr/bin/yum -y install supervisor
php /var/www/html/artisan migrate
php /var/www/html/artisan telescope:prune --hours=0
\cp /var/www/html/config/addons/supervisor-app.txt /etc/supervisord.d/supervisor-app.conf
\cp /var/www/html/config/addons/httpd.txt /etc/httpd/conf/httpd.conf
\cp /var/www/html/config/addons/server_cert.cer /etc/pki/tls/certs/  
\cp /var/www/html/config/addons/server_key.key /etc/pki/tls/private/

 mv /var/www/html/supervisor-app.ini /etc/supervisord.d/

/usr/bin/chown -R apache:apache /var/www/html

