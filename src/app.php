<?php

require_once __DIR__.'/../vendor/autoload.php';

use Silex\Application;
use Guzzle\GuzzleServiceProvider;

$app = new Application();

// Services.
$app->register(new GuzzleServiceProvider(), array(
  'guzzle.services' => '/path/to/services.json',
));

// Routes.
$app->get('/travis', function($name) use($app) {
  return 'You wanna test this action?';
});
$app->get('/patch-check', function($name) use($app) {
  return 'You wanna check this patch?';
});

$app->run();
