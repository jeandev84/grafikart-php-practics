<?php

/*
 * ceil: arrondi au nombre superieur
 * floor: arrondi au nombre inferieur
*/

$title = 'Mon Blog';
$connection = \App\Helpers\Connection::make();

$paginatedQuery = new \App\Helpers\PaginatedQuery(
   "SELECT * FROM post ORDER BY created_at DESC",
"SELECT COUNT(id) FROM post",
           \App\Entity\Post::class
);

$posts  = $paginatedQuery->getItems();
$link   = $router->url('home');
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
    <?= $paginatedQuery->previousLink($link) ?>
    <?= $paginatedQuery->nextLink($link) ?>
</div>