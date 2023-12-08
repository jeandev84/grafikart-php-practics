<?php
# php bin/phpunit.php Validation/ValidatorTest.php

#var_dump($argv);
array_shift($argv);

$path = 'tests';
if (!empty($argv[0])) {
    $path = "tests/". $argv[0] . ".php";
}

shell_exec("./vendor/bin/phpunit $path");
exit(0);