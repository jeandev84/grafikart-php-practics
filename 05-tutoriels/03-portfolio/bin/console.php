<?php
require __DIR__.'/../vendor/autoload.php';

/*
 * $ php bin/console.php database:create --db=YOUR_DATABASE
 *
*/

$console = new \Grafikart\Console\Console();

$console->addCommands([
    new \App\Commands\Database\DatabaseCreateCommand()
]);

$status = $console->run(
    $input = new \Grafikart\Console\Input\ArgvInput(),
    new \Grafikart\Console\Output\ConsoleOutput()
);

exit($status);



