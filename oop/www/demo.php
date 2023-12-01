<?php

require 'Person.php';

$merlin = new Person("Merlin");
$harry  = new Person("Harry");

$merlin->attack($harry);

if ($harry->killed()) {
   echo "Harry is killed :(\n";
} else {
    echo "Harry in life with {$harry->getLife()}\n";
}

//var_dump($merlin);
//var_dump($harry);



