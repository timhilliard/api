<?php

namespace API;

/**
 * @file
 * Defined interface for DrupalCI API.
 */

interface APIInterface {

  /**
   * Information on how to use the API.
   * @return message.
   */
  public function home();

  /**
   * Runs a job.
   * @return id.
   */
  public function jobRun();

  /**
   * Get the status of a job.
   * @return status.
   */
  public function jobStatus($id);

  /**
   * Cancel a job.
   * @return id.
   */
  public function jobCancel($id);

  /**
   * Restarts a job.
   * @return id.
   */
  public function jobRestart($id);

  /**
   * Gets a jobs console output from the dispatcher.
   * @return console output.
   */
  public function jobConsole($id);

  /**
   * Get the results of the build.
   * @return results.
   */
  public function jobResults($id);

  /**
   * Authenticate against the API.
   * @return success.
   */
  public function auth($token);

  /**
   * Get global API status.
   * @return status.
   */
  public function status();

}
