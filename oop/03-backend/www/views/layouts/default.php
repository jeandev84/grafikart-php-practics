<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= isset($title) ? $title : 'Mon super site' ?></title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">Blog</a>
            <?php if (isset($app) && $app['auth']->logged()): ?>
            <span href="" class="navbar-brand text-right">Hi, <?= $user->username ?></span>
            <a class="navbar-brand" href="<?= $router->generate('auth.logout') ?>">
                logout
            </a>
            <?php endif; ?>
        </div>

    </div>
</nav>

<div class="container">

    <div class="starter-template" style="padding-top: 100px;">
         {{ content }}
    </div>

</div><!-- /.container -->



</body>
</html>
