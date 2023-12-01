<?php

require 'Form.php';
require 'Person.php';
require 'Text.php';


$merlin = new Person('Merlin');
$merlin->regenerate();
var_dump($merlin);

$form = new Form($_POST);

var_dump(Text::withZero(10));
?>

<form action="" method="POST">
    <?php
      echo $form->input('username', 'Username');
      echo $form->input('password', 'Username');
      echo $form->submit();
    ?>
</form>
