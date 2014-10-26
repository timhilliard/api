role :app, "10.83.0.6"
set :gateway, "root@140.211.169.76"
set :user, "root"
set :runner, "root"
set :port, 22
set :deploy_to, '/var/www/api'
set :application, 'api.drupalci.org'
set :repository, "https://github.com/nickschuch/drupalci-api.git"
ssh_options[:forward_agent] = true

# Register hooks.
before "deploy:create_symlink", "puppet:apply"
after "puppet:apply", "api:symlink"

# All Puppet related commands.
namespace :puppet do

  # Apply the changes.
  task :apply do
    run "cd #{release_path}/puppet && sh provision.sh"
  end

end

# All Puppet related commands.
namespace :puppet do

  # Apply the changes.
  task :apply do
    run "cd #{release_path}/puppet && sh provision.sh"
  end

end

namespace :api do

  # Symlink the configuration.
  task :symlink do
    run "rm -rf #{release_path}/config.yaml && ln -nfs #{shared_path}/config.yaml #{release_path}/config.yaml"
  end

end
