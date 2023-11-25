<?php
declare(strict_types=1);

namespace App\Service\Game;


use App\Console\Input\ConsolePrompt;

/**
 * Created by PhpStorm at 25.11.2023
 *
 * @Game
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Service\Game
 */
class Game
{
     protected ConsolePrompt $console;


     protected int $action;


     public function __construct(int $action)
     {
         $this->action = $action;
     }



     public function showMessage(): string
     {
          // work like switch ... case
          return match ($this->action) {
              1       => "I attack",
              2       => "I defend",
              3       => "I do nothing",
              default => "Invalid command"
          };
     }
}


$prompt    =  new \App\Console\Input\ConsolePrompt();
$action    =  (int)$prompt->readline("Enter your action (1: attack, 2: defense, 3: pass my turn): ");
$game      =  new \App\Service\Game\Game($action);
echo $game->showMessage(), "\n";