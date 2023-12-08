<?php
declare(strict_types=1);

namespace Tests;


use GuzzleHttp\Psr7\ServerRequest;
use GuzzleHttp\Psr7\Uri;
use PHPUnit\Framework\TestCase;

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

      public function makeRequest(string $path, array $params = [])
      {
           $method = empty($params) ? 'GET' : 'POST';

           return (new ServerRequest($method, new Uri($path)))
                  ->withParsedBody($params);
      }
}