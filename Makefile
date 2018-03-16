mysql-dump:
	rm -rf /files/dump/*
	docker exec gatsby_mysql_1 sh -c 'exec mysqldump wordpress -uroot -ppassword' > dump/tagprints.sql

post:
	root@159.65.240.158 < 'chown -R www-data:www-data /var/www/html'
