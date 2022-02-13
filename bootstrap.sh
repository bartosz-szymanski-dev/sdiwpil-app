#!/usr/bin/env bash

# php
apt-get update
apt-get upgrade -y
apt-get install -y software-properties-common
add-apt-repository ppa:ondrej/php
apt-get update
apt-get install -y php7.4 php7.4-mysql php7.4-zip php7.4-mbstring php7.4-json php7.4-intl php7.4-imap php7.4-fpm php7.4-cli php7.4-bz2 php7.4-bcmath php7.4-opcache php7.4-xml php7.4-xsl php7.4-curl php7.4-soap git

# nginx
apt-get install -y nginx-extras
systemctl enable nginx.service #Auto-start for systemd

# mysql
apt-get install -y mysql-common mysql-server mysql-client
mysql << EOF
CREATE DATABASE sdiwpil;
CREATE USER 'sdiwpil'@'%' IDENTIFIED BY 'secret';
GRANT ALL PRIVILEGES ON sdiwpil . * TO 'sdiwpil'@'%';
FLUSH PRIVILEGES;
EOF
