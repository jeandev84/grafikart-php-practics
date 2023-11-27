<?php

$title = 'Mon Blog';
$request = \Grafikart\Http\Request::createFromGlobals();
$connection = new \Grafikart\Database\Connection\PdoConnection(
     'mysql:dbname=tutoblog;host=127.0.0.1',
'root',
'secret'
);


$page = $request->queries->get('page', 1);

if (! filter_var($page, FILTER_VALIDATE_INT)) {
    throw new Exception("Numero de page invalide");
}

$currentPage = $request->queries->getInt('page', 1);

if ($currentPage <= 0) {
    throw new Exception("Numero de page invalide");
}

# ceil: arrondi au nombre superieur
# floor: arrondi au nombre inferieur
$repository = new \App\Repository\PostRepository($connection);
$count      = $repository->count();
$perPage    = 12;
$pages      = ceil($count / $perPage);

if ($currentPage > $pages) {
    throw new Exception("Cette page n' existe pas");
}

$paginationDto = new \App\DTO\Input\PaginationDto($currentPage, $perPage);
$dto = new \App\DTO\Input\GetPosts($paginationDto);
$posts  = $posts = $repository->findPosts($dto);

?>
<h1>Mon Blog</h1>

<div class="row">
    <?php foreach ($posts as $post): ?>
    <div class="col-md-3">
        <?php require 'card.php'; ?>
    </div>
    <?php endforeach; ?>
</div>

<div class="d-flex justify-content-between my-4">
    <?php if ($currentPage > 1): ?>
        <?php
         $link = $router->url('home');
         if ($currentPage > 2) $link .= '?page='. ($currentPage - 1);
        ?>
        <a href="<?= $link ?>" class="btn btn-primary">
            &laquo; Page precedente
        </a>
    <?php endif; ?>

    <?php if ($currentPage < $pages): ?>
        <a href="<?= $router->url('home') ?>?page=<?= ($currentPage + 1) ?>" class="btn btn-primary ml-auto">
            Page suivante &raquo;
        </a>
    <?php endif; ?>
</div>