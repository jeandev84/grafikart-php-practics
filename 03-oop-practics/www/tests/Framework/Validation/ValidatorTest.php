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

     private function makeValidator(array $params): Validator
     {
         return new Validator($params);
     }



     public function testRequiredIfFail()
     {
          $errors = $this->makeValidator(['name' => 'Joe'])
                         ->required('name', 'content')
                         ->getErrors();

          $this->assertCount(1, $errors);
     }



    public function testRequiredIfSuccess()
    {
        $errors = $this->makeValidator(['name' => 'Joe', 'content' => 'content'])
                       ->required('name', 'content')
                       ->getErrors();

        $this->assertCount(0, $errors);
    }



    public function testSlugSuccess()
    {
        $errors = $this->makeValidator(['slug' => 'aze-aze-azeaze'])
                       ->slug('slug')
                       ->getErrors();

        $this->assertCount(0, $errors);
    }



    public function testSlugError()
    {
        $errors = $this->makeValidator([
            'slug1' => 'aze-aze-azeAze34',
            'slug2' => 'aze-aze_azeAze34',
            'slug3' => 'aze--aze-aze',
         ])
         ->slug('slug1')
         ->slug('slug2')
         ->slug('slug3')
         ->getErrors();

        $this->assertCount(3, $errors);
    }
}