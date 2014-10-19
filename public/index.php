<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\RouteCollection;
use Silex\Application;

$app = new Silex\Application();

/**
 * Error handling.
 */
$app->error(function (\Exception $e, $code) {
  return "Oh no! Something went wrong. Don't even think about contacting your systems administrator.";
});

$app['routes'] = $app->extend('routes', function (RouteCollection $routes, Application $app) {
  $loader = new YamlFileLoader(new FileLocator(__DIR__ . '/../config'));
  $collection = $loader->load('routes.yml');
  $routes->addCollection($collection);
  return $routes;
});

$app->run();
