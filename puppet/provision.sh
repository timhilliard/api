#!/bin/bash

# Script: provision.sh
# Author: Nick Schuch

DIR='/var/www/api/current/puppet'

# Helper function to install packages.
yumInstall() {
  if [ $(rpm -qa | grep ${1} | wc -l) -eq 0 ]; then
    yum -y install $1;
  fi
}

# Helper function to install gems packages.
gemInstall() {
  COUNT=`gem list | grep ${1} | wc -l`
  if [ "${COUNT}" -eq "0" ]; then
    gem install $1
  fi
}

yumInstall ruby-devel
yumInstall git-all
yumInstall vim-common
gemInstall bundler

# Run librarian-puppet to pull down contrib modules.
cd $DIR && bundle install
cd $DIR && bundle exec librarian-puppet install
cd $DIR && sudo -E puppet apply --modulepath $DIR/modules $DIR/site.pp
