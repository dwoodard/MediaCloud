#MediaCloud
##MediaCloud Install Workflow

--------------------

## Install Dependencies 

### 1. Vagrant
Vagrant is use to set up the box. Download and Install from

    http://www.vagrantup.com/
    
Vagrant Plugin for caching installs (speeds up installs)    
    
    vagrant plugin install vagrant-cachier
    
### 2. Composer
Php Dependency manager (its all the new rage) :) Read up on it. **https://getcomposer.org/**
    
#### Windows
    
    https://getcomposer.org/Composer-Setup.exe
    
#### Mac/Linux
    
    curl -sS https://getcomposer.org/installer | php
    mv composer.phar /usr/local/bin/composer

--------------------


### _Great Now that we got our dependencies!!!_

## Setup

### 1. Clone Repo
    
    git clone git@github.com:dwoodard/MediaCloud.git

### 2. Get dependencies from Composer
    
    composer install

### 3. Set up Virtual Box
    
    vagrant up

#### 4. Set Host file 

Vagrant is pointing to 33.33.33.10 `C:\Windows\System32\drivers\etc\hosts`

    33.33.33.10		dev.media.weber.edu

You can Adjust settings in `Vagrantfile`

--------------------

## Install Page
#### Goto install page `https://dev.media.weber.edu/install/index.php`
