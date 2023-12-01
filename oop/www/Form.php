<?php
declare(strict_types=1);


/**
 * Created by PhpStorm at 01.12.2023
 *
 * @Form
 *
 * @author Jean-Claude <jeanyao@ymail.com>
*/
class Form
{

     protected array $data = [];
     protected string $surround = 'p';

     public function __construct(array $data = [])
     {
         $this->data = $data;
     }


     public function surround(string $html): string
     {
         return "<{$this->surround}>$html</$this->surround>";
     }


     public function input(string $name): string
     {
         return $this->surround(
             sprintf('<input type="text" name="%s" value="%s">', $name, $this->getValue($name))
         );
     }



     private function getValue(string $name, $default = null): mixed
     {
         return $this->data[$name] ?? $default;
     }


     public function submit(string $label = 'Envoyer'): string
     {
         return $this->surround(
             sprintf('<button type="submit">%s</button>', $label)
         );
     }
}