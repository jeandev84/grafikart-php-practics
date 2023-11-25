<?php
declare(strict_types=1);

namespace App\Service\Comparator;


/**
 * Created by PhpStorm at 25.11.2023
 *
 * @NoteComparator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Service\Comparator
 */
class NoteComparator
{

      const NOTE = 10;

      protected float|int $note;


      public function __construct(float|int $note)
      {
          $this->note = $note;
      }



      public function match(): bool
      {
           return $this->note == self::NOTE;
      }



      public function greaterThan($value): bool
      {
           return $this->note >= $value;
      }



      public function lessThan($value): bool
      {
          return $this->note <= $value;
      }



      public function equalTo($value): bool
      {
          return ($this->note == $value);
      }
}


$prompt     = new \App\Console\Input\ConsolePrompt();

$note       = (float)$prompt->readline("Enter your note: ");
$comparator = new \App\Service\Comparator\NoteComparator($note);

if($comparator->greaterThan(10)) {
    echo "Congratulations! you have average\n";
} else {
    echo "Sorry, you haven't average\n";
}

