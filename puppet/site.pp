# The node definition.

node default {

  # Base installation.
  class { 'apache':
    default_vhost => false,
    mpm_module => 'prefork',
  }
  apache::listen { '80': }
  apache::mod { 'rewrite': }
  apache::mod { 'php5':
    require => Package['libapache2-mod-php5'],
  }

  # Path configuration.
  apache::vhost { $fqdn:
    port             => '80',
    docroot          => '/var/www/api/public',
    fallbackresource => '/index.php',
  }

  # We want to ensure apt is always updated first.
  class { 'apt': }

  # Repositories.
  apt::ppa { 'ppa:ondrej/php5-oldstable': }

  # Packages.
  package { 'libapache2-mod-php5': ensure => 'installed', require => Apt::Ppa['ppa:ondrej/php5-oldstable'] }
  package { 'php5-curl':           ensure => 'installed', require => Apt::Ppa['ppa:ondrej/php5-oldstable'] }

  # Ensure we have an update to date set of packages.
  exec { 'apt-update':
    command => '/usr/bin/apt-get update'
  }
  Exec["apt-update"] -> Package <| |>

  include pear
  pear::package { 'phing':
    version    => '2.4.13',
    repository => 'pear.phing.info',
  }

}
