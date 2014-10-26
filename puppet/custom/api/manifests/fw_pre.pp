# Rules that should be run first.

class api::fw_pre {
  Firewall {
    require => undef,
  }

  # Default firewall rules

}