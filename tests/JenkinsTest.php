<?php

namespace API;

/**
 * Class JenkinsTest.
 * Test the functionality of the Jenkins class.
 */
class JenkinsTest extends \PHPUnit_Framework_TestCase {

  /**
   * Build a Jenkins object and get the URL that will be used for submission.
   * @expectedException Exception
   */
  public function testBuildUrl() {
    $this->setExpectedException('Exception');

    // Build.
    $guzzle = new GuzzleMock();
    $jenkins = new Jenkins($guzzle);
    $jenkins->setProtocol('https');

    // Check for enforcement of host.
    $request = $jenkins->send();
    $jenkins->setHost('localhost');

    // Check for enforcement of build.
    $request = $jenkins->send();
    $jenkins->setBuild('foo');

    // Check for enforcement of port.
    $request = $jenkins->send();
    $jenkins->setPort('9090');

    // Add the rest so we can test a successful return.
    $jenkins->setToken('99999999');
    $jenkins->setQuery(array(
      'repository' => 'baz',
      'branch' => 'bar',
      'patch' => 'bas'
    ));
    $request = $jenkins->send();

    // Check a successful submission.
    $required = array('https://localhost:9090/job/foo/buildWithParameters', array(
      'query' => array(
        'token' => '99999999',
        'repository' => 'baz',
        'branch' => 'bar',
        'patch' => 'bas',
      ),
    ));
    $this->assertEquals($required, $request);
  }

}
