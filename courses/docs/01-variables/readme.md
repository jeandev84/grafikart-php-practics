### Variables

Example
- Je veux representer un tableau qui va contenir la notes de mes eleves
```php 
<?php

$students = [
    [
        'name'  => 'Student 1',
        'class' => 'Level 1',
        'notes' => [10, 16, 19.5]
    ],
    [
        'name'  => 'Student 2',
        'class' => 'Level 2',
        'notes' => [11, 18.5, 19]
    ],
];
?>

<table>
    <tr>
        <th>Name</th>
        <th>Classes</th>
        <th colspan="12">Notes</th>
        <th>Moyenne</th>
    </tr>
    <?php foreach($students as $student): ?>
    <tr>
        <td>
            <strong><?= $student['name'] ?></strong>
        </td>
        <td><?= $student['class'] ?></td>
        <?php foreach ($student['notes'] as $mark): ?>
         <td><?= $mark ?>/20</td>
        <?php endforeach; ?>
        <td><strong><?= round(array_sum($student['notes']) / count($student['notes']))?></strong>/20</td>
    </tr>
    <?php endforeach; ?>
</table>
```