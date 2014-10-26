# The node definition.

node default {

  include yum::repo::remi_php56

  ##
  # PHP.
  ##

  package {[
    'php-common',
    'php-cli',
    'nmap',
  ]:
    ensure => 'latest',
  }

  ##
  # Apache.
  ##

  class { 'apache':
    default_vhost => false,
    mpm_module    => 'prefork',
  }
  apache::listen { '80': }
  include apache::mod::rewrite
  include apache::mod::php

  apache::vhost { $fqdn:
    port           => '80',
    docroot        => '/var/www/api/current/public',
    manage_docroot => false,
    priority       => '25',
    override       => [ 'ALL' ],
  }

  # Deploy directory structure.
  file {[
    '/var/www/api/releases',
    '/var/www/api/shared',
  ]:
    ensure => 'directory',
    owner  => root,
    group  => root,
    mode   => '0644',
  }

  # Create a dummy configuration file if it does not exist.
  exec { "config_file":
    command => "echo 'Put some config here.' > /var/www/api/shared/config.yaml",
    unless  => "test -s /var/www/api/shared/config.yaml",
  }

  ##
  # Firewall.
  ##

  include firewall
  firewall { '000 accept all icmp':
    proto   => 'icmp',
    action  => 'accept',
  }
  firewall { '001 accept all to lo interface':
    proto   => 'all',
    iniface => 'lo',
    action  => 'accept',
  }
  firewall { '002 accept related established rules':
    proto   => 'all',
    state => ['RELATED', 'ESTABLISHED'],
    action  => 'accept',
  }
  firewall { '100 allow http and https access':
    port   => [80, 443],
    proto  => tcp,
    action => accept,
  }

  ##
  # Misc.
  ##

  Exec { path => [ "/bin/", "/sbin/" , "/usr/bin/", "/usr/sbin/" ] }

}
