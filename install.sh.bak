#!/usr/bin/env bash

echo "--- Good morning, master. Let's get to work. Installing now. ---"



# echo "--- SET RESOLV ---"
# sudo tee -a /etc/resolvconf/resolv.conf.d/tail <<RESOLV
# nameserver 8.8.8.8
# nameserver 8.8.4.4
# RESOLV
# sudo /etc/init.d/resolvconf restart


echo "--- Updating packages list ---"
sudo apt-get update

echo "--- MySQL time ---"
#USERNAME
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password password root'
#PASSWORD
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password root'

echo "--- Installing base packages ---"
sudo apt-get install -y vim curl wget python-software-properties unzip

echo "--- Updating packages list ---"
sudo apt-get update

echo "--- We want the bleeding edge of PHP, right master? ---"
sudo add-apt-repository -y ppa:ondrej/php5

echo "--- Updating packages list ---"
sudo apt-get update

echo "--- Installing PHP-specific packages ---"
sudo apt-get install -y php5 apache2 libapache2-mod-php5 php5-curl php5-gd php5-mcrypt php5-readline mysql-server-5.5 php5-mysql git-core

echo "--- Installing and configuring Xdebug ---"
sudo apt-get install -y php5-xdebug

cat << EOF | sudo tee -a /etc/php5/mods-available/xdebug.ini
xdebug.scream=1
xdebug.cli_color=1
xdebug.show_local_vars=1
EOF








echo "--- Enabling mod-rewrite ---"
sudo a2enmod rewrite

echo "--- Setting document root ---"
sudo rm -rf /var/www
sudo ln -fs /vagrant/public /var/www


echo "--- What developer codes without errors turned on? Not you, master. ---"
sed -i "s/error_reporting = .*/error_reporting = E_ALL/" /etc/php5/apache2/php.ini
sed -i "s/display_errors = .*/display_errors = On/" /etc/php5/apache2/php.ini

sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

echo "--- You like to tinker, don't you master? ---"
sed -i "s/disable_functions = .*/disable_functions = /" /etc/php5/cli/php.ini


echo "--- Set up php.ini (both cli and apache2) ---"

echo "--- post_max_size ---"
sudo sed -i "s/.*post_max_size.*/post_max_size = 2G/" /etc/php5/cli/php.ini
sudo sed -i "s/.*post_max_size.*/post_max_size = 2G/" /etc/php5/apache2/php.ini

echo "--- upload_max_filesize ---"
sudo sed -i "s/.*upload_max_filesize.*/upload_max_filesize = 2G/" /etc/php5/cli/php.ini
sudo sed -i "s/.*upload_max_filesize.*/upload_max_filesize = 2G/" /etc/php5/apache2/php.ini

echo "--- max_input_time ---"
sudo sed -i "s/.*max_input_time.*/max_input_time = 9000/" /etc/php5/apache2/php.ini
sudo sed -i "s/.*max_input_time.*/max_input_time = 9000/" /etc/php5/apache2/php.ini

echo "--- max_file_uploads ---"
sudo sed -i "s/.*max_file_uploads.*/max_file_uploads = 100/" /etc/php5/apache2/php.ini
sudo sed -i "s/.*max_file_uploads.*/max_file_uploads = 100/" /etc/php5/apache2/php.ini

echo "--- memory_limit  ---"
sudo sed -i "s/.*memory_limit .*/memory_limit = 1G/" /etc/php5/apache2/php.ini
sudo sed -i "s/.*memory_limit .*/memory_limit = 1G/" /etc/php5/apache2/php.ini

echo "--- Restarting Apache ---"
sudo service apache2 restart

echo "--- Composer is the future. But you knew that, did you master? Nice job. ---"
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer


echo "--- Correct Time  ---"
echo "America/Denver" | sudo tee /etc/timezone
sudo dpkg-reconfigure --frontend noninteractive tzdata

echo "--- INSTALL BEANSTALKD  ---"
echo "--- INSTALL SUPERVISORD  ---"
sudo apt-get update
sudo apt-get install -y beanstalkd supervisor
sudo sed -i "s/.*#START.*/START yes/" /etc/default/beanstalkd
sudo service beanstalkd start

sudo tee -a /etc/supervisord.conf <<SUPERVISORD
[supervisord]
logfile=/tmp/supervisord.log ; (main log file;default $CWD/supervisord.log)
logfile_maxbytes=50MB        ; (max main logfile bytes b4 rotation;default 50MB)
logfile_backups=10           ; (num of main logfile rotation backups;default 10)
loglevel=info                ; (log level;default info; others: debug,warn,trace)
pidfile=/tmp/supervisord.pid ; (supervisord pidfile;default supervisord.pid)
nodaemon=false               ; (start in foreground if true;default false)
minfds=1024                  ; (min. avail startup file descriptors;default 1024)
minprocs=200                 ; (min. avail process descriptors;default 200)

[program:beanstalkd]
command=php artisan queue:listen --timeout=14400
process_name=%(program_name)s%(process_num)s
numprocs=8
directory=/var/www/MediaCloud
autostart=true
autorestart=true
exitcodes=2
user=root
SUPERVISORD

sudo tee -a /etc/init.d/supervisord <<SUPERVISORDCONF
#! /bin/bash -e

SUPERVISORD=/usr/local/bin/supervisord
PIDFILE=/tmp/supervisord.pid
OPTS="-c /etc/supervisord.conf"

test -x $SUPERVISORD || exit 0

. /lib/lsb/init-functions

export PATH="${PATH:+$PATH:}/usr/local/bin:/usr/sbin:/sbin"

case "$1" in
  start)
    log_begin_msg "Starting Supervisor daemon manager..."
    start-stop-daemon --start --quiet --pidfile $PIDFILE --exec $SUPERVISORD -- $OPTS || log_end_msg 1
    log_end_msg 0
    ;;
  stop)
    log_begin_msg "Stopping Supervisor daemon manager..."
    start-stop-daemon --stop --quiet --oknodo --pidfile $PIDFILE || log_end_msg 1
    log_end_msg 0
    ;;

  restart|reload|force-reload)
    log_begin_msg "Restarting Supervisor daemon manager..."
    start-stop-daemon --stop --quiet --oknodo --retry 30 --pidfile $PIDFILE
    start-stop-daemon --start --quiet --pidfile /var/run/sshd.pid --exec $SUPERVISORD -- $OPTS || log_end_msg 1
    log_end_msg 0
    ;;

  *)
    log_success_msg "Usage: /etc/init.d/supervisor
{start|stop|reload|force-reload|restart}"
    exit 1
esac

exit 0
SUPERVISORDCONF


sudo chmod +x /etc/init.d/supervisord
sudo update-rc.d supervisord defaults

sudo service supervisord start


# echo "--- INSTALL BEANSTALK_CONSOLE  ---"
# wget -P /var/www https://github.com/ptrofimov/beanstalk_console/archive/master.zip
# sudo unzip -o -d /var/www  /var/www/master.zip
# sudo rm /var/www/master.zip
# sudo mv /var/www/beanstalk_console-master /var/www/beanstalkd

