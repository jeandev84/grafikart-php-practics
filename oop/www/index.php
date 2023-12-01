<?php
require 'autoload.php';

$form = new BootstrapForm($_POST);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
<form action="" method="POST">
    <?php
    echo $form->input('username', 'Username');
    echo $form->input('password', 'Username');
    echo $form->submit();
    ?>
</form>

</body>
</html>