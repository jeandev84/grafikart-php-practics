<?php
require_once __DIR__.'/vendor/autoload.php';

/*
$faculty = new \App\Entity\University\Faculty('Mathematics and computers sciences', [
    new \App\Entity\University\Student('Marc', [
        11, 12, 19.5
    ])
]);
*/

$name      = new \App\Entity\University\ValueObject\FullName('John Doe');
$student   = new \App\Entity\University\Student($name, [
    11, 12, 19.5
]);


echo $student->getNote(1), "\n";
echo $student->getFullName()->getName(), "\n";





