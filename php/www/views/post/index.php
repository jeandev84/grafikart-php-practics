<?php
$title = 'Mon Blog';
$connection = \App\Helpers\Connection::make();

$postCategory = new \App\Repository\PostRepository($connection);
[$posts, $pagination] = $postCategory->findPaginated();
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
    <?= $pagination->previousLink($link) ?>
    <?= $pagination->nextLink($link) ?>
</div>