role :app, "10.83.0.6"
set :gateway, "root@140.211.169.76"
set :user, "root"
set :runner, "root"
set :port, 22
set :deploy_to, '/var/www/api'
set :application, 'api.drupalci.org'
set :repository, 'git@github.com:nickschuch/drupalci-api.git'
ssh_options[:forward_agent] = true

# Register hooks.
before "deploy:create_symlink", "puppet:apply"
before "puppet:apply", "puppet:prepare"

# All Puppet related commands.
namespace :puppet do

  # Prepares the puppet repository via librarian puppet.
  task :prepare do
    run "cd #{current_path}/puppet && bundle install --path vendor/bundle > /dev/null"
    run "cd #{current_path}/puppet && bundle exec librarian-puppet install"
  end

  # Apply the changes.
  task :apply do
    run "cd #{current_path}/puppet && bundle exec puppet apply --modulepath ./modules site.pp"
  end

end
