cookbook_file "/etc/nginx/sites-available/gitwalrus.conf" do
  path "gitwalrus.conf"
  owner "root"
  action :create
end