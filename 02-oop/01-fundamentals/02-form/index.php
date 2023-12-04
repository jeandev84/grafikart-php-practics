<?php

use classes\Form;

require 'Form.php';

$form = new Form($_POST);
?>

<form action="" method="POST">
    <?= $form->input('username', 'Username') ?>
    <?= $form->input('password', 'Password'); ?>
    <?= $form->submit(); ?>
</form>
