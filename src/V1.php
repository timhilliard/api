<?php

namespace API;

/**
 * Controller for Version 1 of the DrupalCI API.
 */

class V1 extends APIController implements APIInterface {

  /**
   * Information on how to use the API.
   * @return message.
   */
  public function home() {
    return new Response("Welcome to the DrupalCI API.");
  }

  /**
   * Runs a job.
   * @return id.
   */
  public function jobRun() {
    return new Response("I just started a job.");

    // $repository = $request->get('repository');
    // $branch = $request->get('branch');
    // $patch = $request->get('patch');
    // $query = array(
    //   'repository' => $repository,
    //   'branch' => $branch,
    //   'patch' => $patch,
    // );

    // Let the request begin.
    // $jenkins = new Jenkins($app['guzzle']);
    // $jenkins->setHost($app['config']['jenkins']['host']);
    // $jenkins->setToken($app['config']['jenkins']['token']);
    // $jenkins->setBuild('test');
    // $jenkins->setQuery($query);
    // $return = $jenkins->send();
    // return $return;
  }

  /**
   * Authenticate against the API.
   * @return success.
   */
  public function auth($token) {
    // http://silex.sensiolabs.org/doc/providers/security.html
    return new Response("Not supported.");
  }

}
