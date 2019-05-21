# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
  # For a complete reference, please see the online documentation at
  # https://docs.vagrantup.com.

  config.vm.box = "generic/ubuntu1804"
  config.vm.network "private_network", ip: "192.168.121.2"
  config.vm.synced_folder "./", "/var/www/html", type: "nfs", nfs_udp: false
end
