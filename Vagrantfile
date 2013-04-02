# -*- mode: ruby -*-
# vi: set ft=ruby :

#Vagrant.configure("2") do |config|
Vagrant::Config.run do |config|
    config.vm.box = "quantal64"
    config.vm.box_url = "https://github.com/downloads/roderik/VagrantQuantal64Box/quantal64.box"

    config.vm.network :hostonly, "33.33.33.33"

    config.vm.provision :chef_solo do |chef|
        chef.cookbooks_path = ["cookbooks", "vagrant/mdxp"]
        chef.add_recipe "nginx"
        chef.add_recipe "apt"
        chef.add_recipe "build-essential"
        #chef.add_recipe "php-fpm"
        #chef.add_recipe "nginx"
        chef.add_recipe "php"
        #chef.add_recipe "php::module_mysql"
        chef.add_recipe "php::module_apc"
        chef.add_recipe "composer"
        #chef.add_recipe "mysql"
        #chef.add_recipe "mysql::server"
        chef.add_recipe "git"
        #chef.add_recipe "nodejs"
        chef.json = {
            app: {
                name: "git-walrus",
                web_dir: "/vagrant",
                dev: false
            },
            nginx: {
                user: "vagrant"
            },
            mysql: {
                server_root_password: "",
                server_repl_password: "",
                server_debian_password: "git-walrus"
            },
            nodejs: {
                version: "0.10.0"
            }
        }
    end

    config.vm.provision :shell, :path => "vagrant/server.sh"
end
