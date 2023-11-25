<?php
require_once __DIR__.'/vendor/autoload.php';

$level = new \App\Entity\University\Level('Mathematics and computers sciences', 'MCS001');
$student   = new \App\Entity\University\Student('Marc', [
    11, 12, 19.5
]);

$student->setLevel($level);

echo $student, "\n";
echo $student->getLevel(), "\n";




