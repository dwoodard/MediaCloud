#!/usr/bin/env bash

echo "------------------ Good morning, Let's get to work. Installing now. ------------------"

echo "------------------ Updating packages list ------------------"
sudo apt-get update >> /tmp/install.log 2>&1

echo "------------------ MySQL time ------------------"
#USERNAME
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password password root'
#PASSWORD
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password root'

echo "------------------ Installing base packages ------------------"
sudo apt-get install -y vim curl wget python-software-properties unzip >> /tmp/install.log 2>&1

echo "------------------ Updating packages list ------------------"
sudo apt-get update >> /tmp/install.log 2>&1

echo "------------------ We want the bleeding edge of PHP, right ------------------"
sudo add-apt-repository -y ppa:ondrej/php5

echo "------------------ Updating packages list ------------------"
sudo apt-get update >> /tmp/install.log 2>&1

echo "------------------ Installing PHP-specific packages ------------------"
sudo apt-get install -y php5 apache2 libapache2-mod-php5 php5-curl php5-gd php5-mcrypt php5-readline mysql-server-5.5 php5-mysql git-core >> /tmp/install.log 2>&1

echo "------------------ Installing and configuring Xdebug ------------------"
sudo apt-get install -y php5-xdebug >> /tmp/install.log 2>&1

cat << EOF | sudo tee -a /etc/php5/mods-available/xdebug.ini
xdebug.scream=1
xdebug.cli_color=1
xdebug.show_local_vars=1
EOF


echo "------------------ Enabling mod-rewrite ------------------"
sudo a2enmod rewrite


echo "------------------ Enabling mod-xsendfile ------------------"
sudo apt-get update >> /tmp/install.log 2>&1
sudo apt-get install libapache2-mod-xsendfile >> /tmp/install.log 2>&1
sudo a2enmod xsendfile
sudo invoke-rc.d apache reload

## Fix later
#echo "------------------ Setting document root ------------------"
#sudo rm -rf /var/www
#sudo ln -fs /vagrant /var/www
#:


echo "------------------ Git Clone ------------------"
sudo git clone https://github.com/dwoodard/MediaCloud.git


echo "------------------ Set DocumentRoot to public ------------------"
sudo sed -i "s#<Directory /var/www#<Directory /opt/MediaCloud/public#" /etc/apache2/apache2.conf
sudo sed -i "s#.*DocumentRoot /var/www/html#\tDocumentRoot /opt/MediaCloud/public#" /etc/apache2/sites-enabled/000-default.conf
sudo sed -i "s#\#ServerName www.example.com#ServerName localhost#" /etc/apache2/sites-enabled/000-default.conf


echo "------------------ What developer codes without errors turned on? Not you ------------------"
sudo sed -i "s/error_reporting = .*/error_reporting = E_ALL/" /etc/php5/apache2/php.ini
sudo sed -i "s/display_errors = .*/display_errors = On/" /etc/php5/apache2/php.ini

sudo sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

echo "------------------ You like to tinker, don't you ------------------"
sudo sed -i "s/disable_functions = .*/disable_functions = /" /etc/php5/cli/php.ini


echo "------------------ Set up php.ini (both cli and apache2) ------------------"

echo "------------------ post_max_size ------------------"
sudo sed -i "s/.*post_max_size.*/post_max_size = 3G/" /etc/php5/cli/php.ini
sudo sed -i "s/.*post_max_size.*/post_max_size = 3G/" /etc/php5/apache2/php.ini

echo "------------------ upload_max_filesize ------------------"
sudo sed -i "s/.*upload_max_filesize.*/upload_max_filesize = 3G/" /etc/php5/cli/php.ini
sudo sed -i "s/.*upload_max_filesize.*/upload_max_filesize = 3G/" /etc/php5/apache2/php.ini

echo "------------------ max_input_time ------------------"
sudo sed -i "s/.*max_input_time.*/max_input_time = 9000/" /etc/php5/apache2/php.ini
sudo sed -i "s/.*max_input_time.*/max_input_time = 9000/" /etc/php5/apache2/php.ini

echo "------------------ max_file_uploads ------------------"
sudo sed -i "s/.*max_file_uploads.*/max_file_uploads = 100/" /etc/php5/apache2/php.ini
sudo sed -i "s/.*max_file_uploads.*/max_file_uploads = 100/" /etc/php5/apache2/php.ini

echo "------------------ memory_limit  ------------------"
sudo sed -i "s/.*memory_limit .*/memory_limit = 1G/" /etc/php5/apache2/php.ini
sudo sed -i "s/.*memory_limit .*/memory_limit = 1G/" /etc/php5/apache2/php.ini

echo "------------------ Restarting Apache ------------------"
sudo service apache2 restart

echo "------------------ Composer is the future. But you knew that did you Nice job. ------------------"
sudo curl -sS https://getcomposer.org/installer | sudo php
sudo mv composer.phar /usr/local/bin/composer


echo "------------------ FFMPEG  ------------------"
sudo apt-get install -y ffmpeg >> /tmp/install.log 2>&1
sudo apt-get update >> /tmp/install.log 2>&1
sudo apt-get install -y libavcodec-extra-52 libavdevice-extra-52 libavfilter-extra-0 libavformat-extra-52 libavutil-extra-49 libpostproc-extra-51 libswscale-extra-0 >> /tmp/install.log 2>&1
sudo apt-get install -y libavcodec-extra-53 >> /tmp/install.log 2>&1

echo "------------------ Correct Time  ------------------"
echo "America/Denver" | sudo tee /etc/timezone
sudo dpkg-reconfigure --frontend noninteractive tzdata

echo "------------------ INSTALL BEANSTALKD  ------------------"
echo "------------------ INSTALL SUPERVISORD  ------------------"
sudo apt-get update >> /tmp/install.log 2>&1
sudo apt-get install -y beanstalkd >> /tmp/install.log 2>&1
sudo sed -i "s/.*#START.*/START yes/" /etc/default/beanstalkd

sudo apt-get install -y python-setuptools >> /tmp/install.log 2>&1
sudo easy_install supervisor
sudo apt-get install -y supervisord >> /tmp/install.log 2>&1


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

[program:laravel]
command=sudo php artisan queue:listen --timeout=14400
process_name=%(program_name)s%(process_num)s
numprocs=5
numprocs_start=5
directory=/opt/MediaCloud/
autostart=true
autorestart=true
exitcodes=2
user=root

[program:beanstalkdService]
command=sudo beanstalkd -l 127.0.0.1 -p 11300
process_name=%(program_name)s%(process_num)s
numprocs=1
numprocs_start=1
directory=/
autostart=true
autorestart=true
exitcodes=2
user=root
SUPERVISORD

sudo a2enmod ssl
sudo sed -i "s#.*DocumentRoot /var/www/html#\tDocumentRoot /opt/MediaCloud/public#" /etc/apache2/sites-available/default-ssl.conf
sudo a2ensite default-ssl.conf
sudo service apache2 reload

sudo wget -O /etc/init.d/beanstalkd https://gist.github.com/dwoodard/8257582/raw/73ece556fa468d4ac05deb75b0246c3cfa00abcb/beanstalkd.init.sh
sudo wget -O /etc/init.d/supervisord https://raw.github.com/dwoodard/beanstalkd/master/etc-init.d-supervisord

sudo chmod +x /etc/init.d/supervisord
sudo update-rc.d supervisord defaults

sudo chmod 777 /opt/MediaCloud/app/config
sudo chmod 777 /opt/MediaCloud/app/config/app.php
sudo chmod 777 /opt/MediaCloud/app/storage/*
sudo chmod 777 /opt/MediaCloud/app/storage
sudo chown -R www-data:www-data /opt/MediaCloud


sudo service supervisord start
sudo service apache2 restart


echo "------------------ FTP SETUP. ------------------"
sudo apt-get install vsftpd
sudo sed -i "s/.*#chroot_local_user=YES/chroot_local_user=YES/" /etc/vsftpd.conf
sudo mkdir /opt/MediaCloud/ics
sudo chmod a-w /opt/MediaCloud/ics/
sudo chown ftp:ftp /opt/MediaCloud/ics/
sudo usermod -d /opt/MediaCloud/ics ftp
sudo /etc/init.d/vsftpd restart


echo "------------------ TMUX. ------------------"
sudo apt-get install tmux
