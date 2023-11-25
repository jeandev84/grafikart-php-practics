<?php

/*
$notes = [10, 20, 10, 9, 8];
echo $notes[1] . "\n";

============================================
$student = [
    'Marc',
    'Doe',
    [10, 20, 40]
];

echo $student[2][1]. "\n";

*/


/*
$student = [
    'nom'     => 'Marc',
    'prenom'  => 'Doe',
    'notes'   => [10, 20, 40]
];

echo "{$student['nom']} {$student['prenom']} \n";
echo "{$student['notes'][2]}\n";
$student['prenom'] = 'Jean';

$student[] = 'CM2';

// Ajout de notes
$student['notes'][] = 16;
$student['notes'][] = 13;
$student['notes'][] = 11;
$student['notes'][] = 17;
$student['notes'][] = 16.7;
$student['notes'][] = 12;

//
print_r($student['notes']);
print_r($student);
*/


$classe = [
   [
       'nom'    => 'Doe',
       'prenom' => 'Jean',
       'notes'  => [16, 16, 15],
   ],
   [
        'nom'    => 'Doe',
        'prenom' => 'Jane',
        'notes'  => [12, 15, 17],
   ]
];


echo "{$classe[1]['notes'][1]}\n";

