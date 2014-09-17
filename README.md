DRUPALCI-API
============

## Overview

Provides a front facing API for the DrupalCI project.

## API

**To be written.**

## Vagrant

**Still to be implemented.**

Vagrant is very handy. If you do not run Docker natively the following VM will provide a method for debugging and building and executing of containers locally.

Install Vagrant (1.6.x):

http://www.vagrantup.com/downloads.html
Spin up a VM with Docker with the following command:

```
$ vagrant up
```

## Deployment

**Still to be implemented.**

Capistrano is a great tool for deployment web applications.

### Install

Capistrano can be installed via bundler (http://bundler.io). Run the following command:

```
bundle install
```

To deploy to the DEV run the following command:

```
$ bundle exec cap dev deploy
```

To deploy to the PROD run the following command:

```
$ bundle exec cap prod deploy
```
