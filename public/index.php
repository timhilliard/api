<?php

require_once __DIR__.'/../vendor/autoload.php';

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Application();

/**
 * Environment.
 */
if (getenv('ENV') == 'prod') {
  $app['guzzle'] = new GuzzleHttp\Client();
}
else {
  $app['guzzle'] = new GuzzleMock();
  $config = 'tests/config.yml';
}

/**
 * Services.
 */
$app->register(new DerAlex\Silex\YamlConfigServiceProvider($config));

/**
 * Error handling.
 */
$app->error(function (\Exception $e, $code) {
  // @todo Funny error page.
  return new Response($e);
});

/**
 * Route for sending test jobs to TestBot infrastructure.
 */
$app->get('/travis', function (Request $request) use ($app) {
  $repository = $request->get('repository');
  $branch = $request->get('branch');
  $patch = $request->get('patch');
  $query = array(
    'repository' => $repository,
    'branch' => $branch,
    'patch' => $patch,
  );

  // Let the request begin.
  $jenkins = new Jenkins($app['guzzle']);
  $jenkins->setHost($app['config']['jenkins']['host']);
  $jenkins->setToken($app['config']['jenkins']['token']);
  $jenkins->setBuild('test');
  $jenkins->setQuery($query);
  $return = $jenkins->send();
  return $return;
});

/**
 * Route for sending patch merge checks
 */
$app->get('/patch/check', function (Request $request) {
  return 'This is not yet implemented.';
});

$app->run();
