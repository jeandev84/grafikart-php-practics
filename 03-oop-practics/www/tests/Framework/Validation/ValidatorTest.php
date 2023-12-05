<?php
declare(strict_types=1);

namespace Tests\Framework\Validation;


use Framework\Validation\Validator;
use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm at 05.12.2023
 *
 * @ValidatorTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Tests\Framework\Validation
 */
class ValidatorTest extends TestCase
{

     public function testRequired()
     {
          $errors = (new Validator([
              'name' => 'Joe'
          ]))->required('name', 'content')
             ->getErrors();

          $this->assertCount(1, $errors);
     }
}