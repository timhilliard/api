<?php

/**
 * Class Jenkins
 * A generic build trigger class for Jenkins remote API calls.
 */
class Jenkins {

  /**
   * @var string
   */
  protected $protocol = 'http://';

  /**
   * @var string
   */
  protected $host = '';

  /**
   * @var string
   */
  protected $port = '80';

  /**
   * @var string
   */
  protected $path = '';

  /**
   * @var string
   */
  protected $token = '';

  /**
   * @var string
   */
  protected $build = '';

  /**
   * @var array
   */
  protected $query = array();

  /**
   * @var \GuzzleHttp\Client
   */
  protected $client = false;

  public function __construct($client) {
  	if (!empty($guzzle)) {
      $this->client = $guzzle;
  	}
  	else {
  	  $this->client = new GuzzleHttp\Client();
  	}
  }

  /**
   * Send the data to the remote Jenkins host.
   */
  public function send() {
    // Ensure we have a host.
    $host = $this->getHost();
    if (!$host) {
      throw new Exception('Please provide a Jenkins host.');
    }

    // Ensure we have a build.
    $build = $this->getBuild();
    if (!$build) {
      throw new Exception('Please provide a Jenkins build.');
    }

    // Ensure we have a port.
    $port = $this->getPort();
    if (!$port) {
      throw new Exception('Please provide a Jenkins port.');
    }

    // Add the Token to the query if it is set.
    $token = $this->getToken();
    $query = $this->getQuery();
    if ($token) {
      $query['token'] = $token;
    }

    // Post the request to Jenkins.
    $build = $this->getBuild();
    $client = $this->getClient();
    $client->get($build, [
      'query' => $this->getQuery(),
    ]);

    return "The request has been passed on to the dispatcher.";
  }

  /**
   * Helper function to build the URL of the Jenkins host.
   */
  protected function buildUrl() {
    $protocol = $this->getProtocol();
    $host = $this->getHost();
    $port = $this->getPort();
    $build = $this->getBuild();
    return $protocol . $host . ':' . $port . '/job/' . $build . '/buildWithParameters';
  }

  /**
   * @return string
   */
  public function getBuild() {
    return $this->build;
  }

  /**
   * @param string $build
   */
  public function setBuild($build) {
    $this->build = $build;
  }

  /**
   * @return \GuzzleHttp\Client
   */
  public function getClient() {
    return $this->client;
  }

  /**
   * @param \GuzzleHttp\Client $client
   */
  public function setClient($client) {
    $this->client = $client;
  }

  /**
   * @return string
   */
  public function getHost() {
    return $this->host;
  }

  /**
   * @param string $host
   */
  public function setHost($host) {
    $this->host = $host;
  }

  /**
   * @return string
   */
  public function getPath() {
    return $this->path;
  }

  /**
   * @param string $path
   */
  public function setPath($path) {
    $this->path = $path;
  }

  /**
   * @return string
   */
  public function getPort() {
    return $this->port;
  }

  /**
   * @param string $port
   */
  public function setPort($port) {
    $this->port = $port;
  }

  /**
   * @return string
   */
  public function getProtocol() {
    return $this->protocol;
  }

  /**
   * @param string $protocol
   */
  public function setProtocol($protocol) {
    $this->protocol = $protocol;
  }

  /**
   * @return array
   */
  public function getQuery() {
    return $this->query;
  }

  /**
   * @param array $query
   */
  public function setQuery($query) {
    $token = $this->getToken();
    if ($token) {
      $query['token'] = $token;
    }
    $this->query = $query;
  }

  /**
   * @return string
   */
  public function getToken() {
    return $this->token;
  }

  /**
   * @param string $token
   */
  public function setToken($token) {
    $this->token = $token;
  }

}
