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