#!/bin/bash

echo "(Setting up your Vagrant box...)"

echo "(Updating apt-get...)"
sudo add-apt-repository ppa:ondrej/php
sudo apt-get update
sudo apt-get install -y php7.1
sudo apt-get install -y php7.1-fpm php-mysql > /dev/null 2>&1
sudo apt-get install -y php7.1-xdebug > /dev/null 2>&1

# Nginx
echo "(Installing Nginx...)"
sudo service apache2 stop
sudo apt-get install -y nginx php7.1-cli php7.1-cgi php7.1-fpm > /dev/null 2>&1



# MySQL
echo "(Preparing for MySQL Installation...)"
sudo apt-get install -y debconf-utils > /dev/null 2>&1
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password password root"
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password_again password root"



echo "(Installing MySQL...)"
sudo apt-get install -y mysql-server > /dev/null 2>&1


# Nginx Config
echo "(Overwriting default Nginx config to work with PHP...)"
sudo rm -rf /etc/nginx/sites-available/default > /dev/null 2>&1
cp /var/www/.provision/nginx_vhost /etc/nginx/sites-available/default > /dev/null 2>&1

# Restarting Nginx for config to take effect
echo "(Restarting Nginx for changes to take effect...)"
sudo service nginx restart > /dev/null 2>&1

echo "(Setting Ubuntu (user) password to \"vagrant\"...)"
echo "ubuntu:vagrant" | chpasswd

echo "(Cleaning up additional setup files and logs...)"
sudo rm -r /var/www/html
# sudo rm /var/www/ubuntu-xenial-16.04-cloudimg-console.log

sudo apt-get update

sudo apt-get install -y curl

sudo curl -s https://getcomposer.org/installer | php

sudo mv composer.phar /usr/local/bin/composer


sudo apt-get install -y php-xdebug > /dev/null 2>&1


sudo service nginx restart > /dev/null 2>&1