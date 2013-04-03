# -*- mode: ruby -*-
# vi: set ft=ruby :

#Vagrant.configure("2") do |config|
Vagrant::Config.run do |config|
    config.vm.box = "quantal64"
    config.vm.box_url = "https://github.com/downloads/roderik/VagrantQuantal64Box/quantal64.box"
    config.vm.network :hostonly, "33.33.33.33"
    config.vm.share_folder "main", "/vagrant", ".", :nfs => true
    #config.vm.customize ["modifyvm", :id, "--memory", 512]
    config.vm.provision :chef_solo do |chef|
        chef.cookbooks_path = ["cookbooks", "vagrant"]
        chef.add_recipe "apt"
        chef.add_recipe "build-essential"
        chef.add_recipe "php"
        chef.add_recipe "php-fpm"
        chef.add_recipe "composer"
        chef.add_recipe "git"
        chef.add_recipe "nginx"
        chef.add_recipe "git-walrus"
        chef.json = {
            app: {
                name: "git-walrus",
                web_dir: "/vagrant",
                dev: false
            },
            nginx: {
                user: 'vagrant',
                default_site_enabled: false
            }
        }
    end
end
