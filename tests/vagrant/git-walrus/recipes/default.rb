cookbook_file "/etc/nginx/sites-available/gitwalrus.conf" do
  source "gitwalrus.conf"
  owner "root"
  group "root"
  mode 0644
  action :create
end


link "/etc/nginx/sites-enabled/gitwalrus.conf" do
  to "/etc/nginx/sites-available/gitwalrus.conf"
  link_type :symbolic
end

service "nginx" do
  action :reload
end

directory "/test_repository" do
  action :delete
  recursive true
end

directory "/test_repository" do
  owner "vagrant"
  group "vagrant"
  mode 00755
  action :create
end

execute "build_repository" do
  cwd "/vagrant"
  user "vagrant"
  group "vagrant"
  command "php tests/_data/build_repository.php"
end