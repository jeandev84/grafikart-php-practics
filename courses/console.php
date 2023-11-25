<?php
require_once __DIR__.'/vendor/autoload.php';

/*
$faculty = new \App\Entity\University\Faculty('Mathematics and computers sciences', [
    new \App\Entity\University\Student('Marc', [
        11, 12, 19.5
    ])
]);
*/

$student   = new \App\Entity\University\Student('Marc', [
    11, 12, 19.5
]);


echo $student, "\n";





