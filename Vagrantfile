# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

Vagrant.require_plugin 'vagrant-cachier'

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|


	config.cache.enable :apt
	config.cache.enable :composer

    config.vm.box = "base"

	#config.vm.box_url = "http://files.vagrantup.com/precise32.box"
	config.vm.box_url = "http://files.vagrantup.com/precise64.box"


	config.vm.provider :virtualbox do |vb|
	  vb.customize ["modifyvm", :id, "--memory", "512"]
	  #vb.customize ["modifyvm", :id, "--memory", "1024"]
	  #vb.customize ["modifyvm", :id, "--memory", "4096"]
	end

    config.vm.network :forwarded_port, guest: 80, host: 8080

    # Install 'vagrant-cachier' via command line:
    # vagrant plugin install vagrant-cachier
	if Vagrant.has_plugin?("vagrant-cachier")
	config.cache.auto_detect = true
		# If you are using VirtualBox, you might want to enable NFS for shared folders
	    config.vm.provision :shell, :path => "install.sh"
	end


end
