<?php
declare(strict_types=1);

namespace Tests\Framework\Twig;


use Framework\Twig\TextExtension;
use Framework\Twig\TimeExtension;
use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm at 05.12.2023
 *
 * @TimeExtensionTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Tests\Framework\Twig
 */
class TimeExtensionTest extends TestCase
{

      protected $timeExtension;

      public function setUp(): void
      {
          $this->timeExtension = new TimeExtension();
      }


      public function testDateFormat()
      {
           $date = new \DateTime();
           $format =  $date->format('d/m/Y H:i');
           $result = '<span class="timeago" datetime="'. $date->format(\DateTime::ISO8601) .'">'. $format .'</span>';
           $this->assertEquals($result, $this->timeExtension->ago($date));
      }
}