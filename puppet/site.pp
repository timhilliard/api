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

}
