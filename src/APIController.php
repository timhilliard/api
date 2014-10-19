<?php

namespace API;

use Symfony\Component\HttpFoundation\Response;
use Silex\Application;

/**
 * @file
 * A base controller class that we can extend from for future API.
 */

class APIController implements APIInterface {

  /**
   * Information on how to use the API.
   * @return message.
   */
  public function home() {
    return new Response("Not supported.");
  }

  /**
   * Runs a job.
   * @return id.
   */
  public function jobRun() {
    return new Response("Not supported.");
  }

  /**
   * Get the status of a job.
   * @return status.
   */
  public function jobStatus($id) {
    return new Response("Not supported.");
  }

  /**
   * Cancel a job.
   * @return id.
   */
  public function jobCancel($id) {
    return new Response("Not supported.");
  }

  /**
   * Restarts a job.
   * @return id.
   */
  public function jobRestart($id) {
    return new Response("Not supported.");
  }

  /**
   * Gets a jobs console output from the dispatcher.
   * @return console output.
   */
  public function jobConsole($id) {
    return new Response("Not supported.");
  }

  /**
   * Get the results of the build.
   * @return results.
   */
  public function jobResults($id) {
    return new Response("Not supported.");
  }

  /**
   * Authenticate against the API.
   * @return success.
   */
  public function auth($token) {
    return new Response("Not supported.");
  }

  /**
   * Get global API status.
   * @return status.
   */
  public function status() {
    return new Response("Not supported.");
  }

}
