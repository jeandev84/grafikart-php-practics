<?php
declare(strict_types=1);

namespace Tests;


use GuzzleHttp\Psr7\ServerRequest;
use GuzzleHttp\Psr7\Uri;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Created by PhpStorm at 08.12.2023
 *
 * @ActionTestCase
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Tests
 */
class ActionTestCase extends TestCase
{

      protected function makeRequest(string $path = '/', array $params = [])
      {
           $method = empty($params) ? 'GET' : 'POST';

           return (new ServerRequest($method, new Uri($path)))
                  ->withParsedBody($params);
      }


      protected function assertRedirect(ResponseInterface $response, string $path)
      {
           $this->assertSame(301, $response->getStatusCode());
           $this->assertEquals([$path], $response->getHeader('Location'));
      }
}