<?php

require_once __DIR__.'/vendor/autoload.php';

/*
$func = function (string $name) {
    return "Salut $name";
};

var_dump($func);

echo $func('Jean');
*/

$students = [
    [
        'name' => 'Anne',
        'age' => 18,
        'average' => 15
    ],
    [
        'name' => 'Marc',
        'age' => 21,
        'average' => 13
    ],
    [
        'name' => 'Jean',
        'age' => 20,
        'average' => 18
    ],
    [
        'name' => 'Marie',
        'age' => 20,
        'average' => 9
    ]
];


/*
$sortAge = function ($student1, $student2) {
    return $student1['age'] - $student2['age'];
};

usort($students, $sortAge);
dump($students);

$sortAverage = function ($student1, $student2) {
    return $student1['average'] - $student2['average'];
};

usort($students, $sortAverage);
dump($students);

$key = 'average';
$sort = function ($student1, $student2) use ($key){
    return $student1[$key] - $student2[$key];
};

usort($students, $sort);
dump($students);
*/


function sorterByKey(array $items, string $key): array {

    usort($items, function ($a, $b) use ($key){
        return $a[$key] - $b[$key];
    });

    return $items;
}


/*
$sortedStudents = sorterByKey($students, 'age');
$sortedStudents = sorterByKey($students, 'average');
dump($sortedStudents);
*/

$admittedStudents = array_filter($students, function (array $student) {
     return $student['average'] > 10;
});

dump($admittedStudents);





