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




    public function testNotEmpty()
    {
        $errors = $this->makeValidator(['name' => 'Joe', 'content' => ''])
            ->notEmpty('content')
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
         ->slug('slug4')
         ->getErrors();

        $this->assertCount(3, $errors);
    }




    public function testLength()
    {
        $params = ['slug' => '123456789'];
        $this->assertCount(0, $this->makeValidator($params)->length('slug', 3)->getErrors());
        $errors = $this->makeValidator($params)->length('slug', 12)->getErrors();
        $this->assertCount(1, $errors);
        $this->assertEquals("Le champs slug doit contenir plus de 12 caracteres", $errors['slug']);
        $this->assertCount(1, $this->makeValidator($params)->length('slug', 3, 4)->getErrors());
        $this->assertCount(0, $this->makeValidator($params)->length('slug', 3, 20)->getErrors());
        $this->assertCount(0, $this->makeValidator($params)->length('slug', null, 20)->getErrors());
        $this->assertCount(1, $this->makeValidator($params)->length('slug', null, 8)->getErrors());
    }




    public function testDatetime()
    {
         $params = ['date' => '2012-12-12 11:12:13'];

         $this->assertCount(0, $this->makeValidator(['date' => '2012-12-12 11:12:13'])->dateTime('date')->getErrors());
         $this->assertCount(0, $this->makeValidator(['date' => '2012-12-12'])->dateTime('date')->getErrors());
         $this->assertCount(1, $this->makeValidator(['date' => '2012-21-12'])->dateTime('date')->getErrors());
         $this->assertCount(1, $this->makeValidator(['date' => '2013-02-29 11:12:13'])->dateTime('date')->getErrors());
    }

}