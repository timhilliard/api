# Rules that are to be run last.

class api::fw_post {
  # We could block all remaining traffic, but for now we don't.
  # firewall { '999 drop all':
  #   proto   => 'all',
  #   action  => 'drop',
  #   before  => undef,
  # }
}
