# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|


    config.vm.box = "base"

    #config.vm.box_url = "http://files.vagrantup.com/precise32.box"
    config.vm.box_url = "http://files.vagrantup.com/precise64.box"

	config.vm.provider :virtualbox do |vb|
	  vb.customize ["modifyvm", :id, "--memory", "1024"]
	end

    config.vm.network :forwarded_port, guest: 80, host: 8080

    config.vm.provision :shell, :path => "install.sh"
end
