<!doctype html>
<html lang="fr" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= isset($title) ? e($title) : 'Mon site' ?></title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <style>
        .btn_disconnect {
            background: transparent;
            border: none;
        }
    </style>
</head>
<body class="d-flex flex-column h-100">

<nav class="navbar navbar-expand-lg navbar-dark btn-primary">
    <a href="<?= $router->url('home') ?>" class="navbar-brand">Mon site</a>
    <ul class="navbar-nav">
        <li class="nav-item">
            <a href="<?= $router->url('admin.posts') ?>" class="nav-link">Articles</a>
        </li>
        <li class="nav-item">
            <a href="<?= $router->url('admin.categories') ?>" class="nav-link">Categories</a>
        </li>
        <li class="nav-item">
            <form action="<?= $router->url('logout') ?>" method="post" style="display: inline">
               <button type="submit" class="nav-link btn_disconnect">Se deconnecter</button>
            </form>
        </li>
    </ul>
</nav>

<div class="container mt-4">
    {{ content }}
</div>

<footer class="bg-light py-4 footer mt-auto">
    <div class="container">
        <?php if (defined('DEBUG_TIME')): ?>
            Page generee en <?= round(1000 * (microtime(true) - DEBUG_TIME)) ?> ms
        <?php endif; ?>
    </div>
</footer>
</body>
</html>