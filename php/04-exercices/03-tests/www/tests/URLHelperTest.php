<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;


/**
 * Created by PhpStorm at 26.11.2023
 *
 * @URLHelperTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
*/
class URLHelperTest extends TestCase
{

     public function assertURLEquals(string $expected, string $url)
     {
         $this->assertEquals($expected, urldecode($url));
     }



     public function testWithParam()
     {
          $url = \App\URLHelper::withParam([], 'k', 3);

          $this->assertURLEquals("k=3", $url);
     }



     public function testWithParamWithArray()
     {
         $url = \App\URLHelper::withParam([], 'k', [3, 2, 1]);

         $this->assertURLEquals("k=3,2,1", $url);
     }




     public function testWithParams()
     {
         # $url = \App\URLHelper::withParamsForTest(["a" => 3], ["a" => 5, "b" => 6]);

         $url = \App\URLHelper::withParams(["a" => 3], ["a" => 5, "b" => 6]);

         $this->assertURLEquals("a=5&b=6", $url);
     }



     public function testWithParamsWithArray()
     {
         # Failure
         $url = \App\URLHelper::withParams(["a" => 3], ["a" => [5, 6], "b" => 6]);
         $this->assertURLEquals("a=5,6&b=6", $url);
     }
}