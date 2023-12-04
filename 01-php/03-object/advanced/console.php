<?php
require_once __DIR__.'/vendor/autoload.php';


$prompt     = new \App\Console\Input\ConsolePrompt();
$action    =  $action = (int)$prompt->readline("Enter your action (1: attack, 2: defense, 3: pass my turn): ");
$game      = new \App\Service\Game\Game($action);
echo $game->showMessage(), "\n";













