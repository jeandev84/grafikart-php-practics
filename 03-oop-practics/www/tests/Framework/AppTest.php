<?php
declare(strict_types=1);

namespace Tests\Framework;


use Framework\App;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm at 04.12.2023
 *
 * @AppTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Tests\Framework
 *
 * Lunch ./vendor/bin/phpunit tests/Framework/AppTest.php
 */
class AppTest extends TestCase
{
     public function testRedirectTrailingSlash()
     {
          $app = new App();
          $request = new ServerRequest('GET', '/demoslash/');
          $response = $app->run($request);
          $this->assertContains('/demoslash', $response->getHeader('Location'));
          $this->assertEquals(301, $response->getStatusCode());
     }
}