<?php
declare(strict_types=1);

namespace App\Console\Output;


/**
 * Created by PhpStorm at 25.11.2023
 *
 * @ConsoleOutput
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Console\Output
 */
class ConsoleOutput
{

     protected array $messages = [];


     public function write(string $message): self
     {
         $this->messages[] = $message;

         return $this;
     }



     public function writeln(string $message): self
     {
          return $this->write(sprintf('%s%s', $message, PHP_EOL));
     }




     public function __toString(): string
     {
          return join($this->messages);
     }
}