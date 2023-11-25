<?php

# require_once __DIR__ . '/vendor/autoload.php';


class Classroom {
    protected $students = [];


    public function __construct(array $students)
    {
        $this->students = $students;
    }



    public function sortByKey(string $key): array {

        usort($this->students, function ($a, $b) use ($key){
            return $a[$key] - $b[$key];
        });

        return $this->students;
    }



    public function isGreaterThanThen(array $student): bool
    {
         return $student['average'] > 10;
    }


    private function getGoodStudentsFromCallback()
    {
        return array_filter($this->students, [$this, 'isGreaterThanThen']);
    }


    public function getGoodStudents(): array {
        return array_filter($this->students, function (array $student) {
            return $student['average'] > 10;
        });
    }
}

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

$classroom = new Classroom($students);
$students = $classroom->getGoodStudents();
dump($students);





