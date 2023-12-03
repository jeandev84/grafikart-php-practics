<?php

require __DIR__.'/vendor/autoload.php';

/*
$hello = new \App\Service\Great\Hello();
$hello = new \App\Service\Great\HelloCava();
echo $hello->sayHello();
*/

$hello = new \App\Service\Great\Hello();
$hello = new \App\Service\Decorator\CavaDecorator($hello);
echo $hello->sayHello();