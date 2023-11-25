<?php


echo "Print notes\n";
$notes         = [10, 20, 13];
$affectedNotes = $notes;
$affectedNotes[] = 10;

// var_dump($notes, $affectedNotes);
print_r($notes);
print_r($affectedNotes);


echo "Print referenced &";
$notes         = [10, 20, 13, 12];
$affectedNotes = &$notes;
$affectedNotes[] = 10;

print_r($notes);
print_r($affectedNotes);

