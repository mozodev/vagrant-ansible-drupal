# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|

  config.vm.box = "precise64"

  config.vm.network :private_network, ip: "192.168.33.11"

  # config.vm.network :public_network
  # config.vm.synced_folder "../data", "/vagrant_data"
  # config.vm.synced_folder ".", "/vagrant", :nfs => true
  config.vm.synced_folder ".", "/vagrant", id: "vagrant-root", nfs: true

  config.vm.provider :virtualbox do |vb|
    vb.customize ["modifyvm", :id, "--name", "precise64"]
    vb.customize ["modifyvm", :id, "--memory", "1024"]
  end

  config.vm.provision :ansible do |ansible|
    ansible.playbook = "provisioning/setup.yml"
    ansible.inventory_file = "provisioning/ansible_host"
  end

end
