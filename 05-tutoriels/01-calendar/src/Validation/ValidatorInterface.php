<?php
declare(strict_types=1);

namespace App\Validation;


/**
 * ValidatorInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Validation
*/
interface ValidatorInterface
{
     /**
      * @param array $data
      *
      * @return array|false
     */
     public function validates(array $data);
}