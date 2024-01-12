<?php
declare(strict_types=1);

namespace App\Validators;

use App\Validation\Validator;

/**
 * EventValidator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Validators
 */
class EventValidator extends Validator
{

      /**
       * @inheritDoc
      */
      public function validates(array $data): array
      {
          parent::validates($data);
          $this->validate('name', 'minLength', 30);
          $this->validate('date', 'date');
          #$this->validate('start', 'time');
          #$this->validate('end', 'time');
          $this->validate('start', 'beforeTime', 'end');
          return $this->errors;
      }
}