#!/usr/bin/env bash

# Update Package List
apt-get update
apt-get upgrade -y

# Force Locale
apt-get install -y locales
echo "LC_ALL=en_US.UTF-8" >> /etc/default/locale
locale-gen en_US.UTF-8
export LANG=en_US.UTF-8

# Install ssh server
apt-get -y install openssh-server pwgen
mkdir -p /var/run/sshd
sed -i "s/UsePrivilegeSeparation.*/UsePrivilegeSeparation no/g" /etc/ssh/sshd_config
sed -i "s/UsePAM.*/UsePAM no/g" /etc/ssh/sshd_config
sed -i "s/PermitRootLogin.*/PermitRootLogin yes/g" /etc/ssh/sshd_config

# Basic packages
apt-get install -y sudo software-properties-common nano curl rsync \
build-essential dos2unix gcc git git-flow libpcre3-dev apt-utils \
make python2.7-dev python-pip re2c supervisor unattended-upgrades whois vim zip unzip

# Create sdiwpil user
adduser sdiwpil
usermod -p $(echo secret | openssl passwd -1 -stdin) sdiwpil
# Add sdiwpil to the sudo group and www-data
usermod -aG sudo sdiwpil
usermod -aG www-data sdiwpil

# Timezone
ln -sf /usr/share/zoneinfo/UTC /etc/localtime

# PHP
apt update -y
apt upgrade -y

apt install software-properties-common -y
add-apt-repository ppa:ondrej/php -y
apt update -y

apt install -y php8.1-common php8.1-mysql php8.1-xml php8.1-xmlrpc php8.1-curl php8.1-gd php8.1-imagick php8.1-cli \
 php8.1-dev php8.1-imap php8.1-mbstring php8.1-opcache php8.1-soap php8.1-zip php8.1-intl

# Nginx & PHP-FPM
apt install nginx php8.1-fpm -y

# Install Composer
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === '906a84df04cea2aa72f40b5f787e49f22d4c2f19492ac310e8cba5b96ac8b64115ac402c8cd292b8a03482574915d1a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php --version=2.1.12
php -r "unlink('composer-setup.php');"
mv composer.phar /usr/local/bin/composer

# Add Composer Global Bin To Path
printf "\nPATH=\"/home/sdiwpil/.composer/vendor/bin:\$PATH\"\n" | tee -a /home/sdiwpil/.profile

# Set Some PHP CLI Settings
sed -i "s/error_reporting = .*/error_reporting = E_ALL/" /etc/php/8.1/cli/php.ini
sed -i "s/display_errors = .*/display_errors = On/" /etc/php/8.1/cli/php.ini
sed -i "s/memory_limit = .*/memory_limit = 512M/" /etc/php/8.1/cli/php.ini
sed -i "s/;date.timezone.*/date.timezone = UTC/" /etc/php/8.1/cli/php.ini

sed -i "s/.*daemonize.*/daemonize = no/" /etc/php/8.1/fpm/php-fpm.conf
sed -i "s/error_reporting = .*/error_reporting = E_ALL/" /etc/php/8.1/fpm/php.ini
sed -i "s/display_errors = .*/display_errors = On/" /etc/php/8.1/fpm/php.ini
sed -i "s/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/" /etc/php/8.1/fpm/php.ini
sed -i "s/memory_limit = .*/memory_limit = 512M/" /etc/php/8.1/fpm/php.ini
sed -i "s/;date.timezone.*/date.timezone = UTC/" /etc/php/8.1/fpm/php.ini

# Enable Remote xdebug
echo "xdebug.remote_enable = 1" >> /etc/php/8.1/fpm/conf.d/20-xdebug.ini
echo "xdebug.remote_connect_back = 1" >> /etc/php/8.1/fpm/conf.d/20-xdebug.ini
echo "xdebug.remote_port = 9000" >> /etc/php/8.1/fpm/conf.d/20-xdebug.ini
echo "xdebug.var_display_max_depth = -1" >> /etc/php/8.1/fpm/conf.d/20-xdebug.ini
echo "xdebug.var_display_max_children = -1" >> /etc/php/8.1/fpm/conf.d/20-xdebug.ini
echo "xdebug.var_display_max_data = -1" >> /etc/php/8.1/fpm/conf.d/20-xdebug.ini
echo "xdebug.max_nesting_level = 500" >> /etc/php/8.1/fpm/conf.d/20-xdebug.ini

# Not xdebug when on cli
phpdismod -s cli xdebug

# Set The Nginx & PHP-FPM User
sed -i '1 idaemon off;' /etc/nginx/nginx.conf
sed -i "s/user www-data;/user sdiwpil;/" /etc/nginx/nginx.conf
sed -i "s/# server_names_hash_bucket_size.*/server_names_hash_bucket_size 64;/" /etc/nginx/nginx.conf

mkdir -p /run/php
touch /run/php/php8.1-fpm.sock
sed -i "s/user = www-data/user = sdiwpil/" /etc/php/8.1/fpm/pool.d/www.conf
sed -i "s/group = www-data/group = sdiwpil/" /etc/php/8.1/fpm/pool.d/www.conf
sed -i "s/;listen\.owner.*/listen.owner = sdiwpil/" /etc/php/8.1/fpm/pool.d/www.conf
sed -i "s/;listen\.group.*/listen.group = sdiwpil/" /etc/php/8.1/fpm/pool.d/www.conf
sed -i "s/;listen\.mode.*/listen.mode = 0666/" /etc/php/8.1/fpm/pool.d/www.conf

# Memcached
apt-get install -y memcached less nano

cp /var/www/html/deploy/templates/nginx.conf /etc/nginx/nginx.conf
cp /var/www/html/deploy/templates/default.conf /etc/nginx/sites-available/default

service nginx start -d
service php8.1-fpm start -d

nginx -s reload
