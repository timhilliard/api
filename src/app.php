<?php

require_once __DIR__.'/../vendor/autoload.php';

use Silex\Application;
use Guzzle\GuzzleServiceProvider;

$app = new Application();

// Routes.
$app->get('/test', function($name) use($app) {
  $repository = $request->get('repository');
  $branch = $request->get('branch');
  $patch = $request->get('patch');

  // Ensure we have a repository.
  if (!$repository) {
    return 'You need to specify a repository.';
  }
  if (!$branch) {
    return 'You need to specify a branch.';
  }

  $query => array(
  	'token' => 'kJhvKGGyAHeRzLjrstnMbS9S',
    'repository' => $repository,
    'branch' => $branch,
    'patch' => $patch,
  );
  $client = new GuzzleHttp\Client();
  $res = $client->get('http://107.170.87.127:8080/job/test-patch/build', [
    'query' => $query,
  ]);
  
  return 'We have sent your build to the dispatcher.';
});

$app->run();
