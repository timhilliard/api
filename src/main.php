<?php

$loader = require_once __DIR__.'/../vendor/autoload.php';
$loader->add('', __DIR__);

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\RouteCollection;
use DerAlex\Silex\YamlConfigServiceProvider;
use Silex\Application;
use Silex\Provider\SecurityServiceProvider;
use Silex\Provider\MonologServiceProvider;

$app = new Silex\Application();

/**
 * Environment.
 */
if (file_exists('config.yaml')) {
  $config = '../config/config.yaml';
}
else {
  $config = '../config/config-test.yaml';
}

/**
 * Services.
 */
$app->register(new YamlConfigServiceProvider($config));

/**
 * Handling.
 */
$app->error(function (\Exception $e, $code) {
  error_log($e);
  return "Something went wrong. Please contact the DrupalCI team.";
});

if ($app['config']['log-file']) {
  $app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' =>  $app['config']['log-file'],
    'monolog.name' => 'Drupal CI API',
  ));
}

/**
 * Routing.
 */
$app['routes'] = $app->extend('routes', function (RouteCollection $routes, Application $app) {
  $loader = new YamlFileLoader(new FileLocator(__DIR__));
  $collection = $loader->load('routes.yml');
  $routes->addCollection($collection);
  return $routes;
});

$app->run();
