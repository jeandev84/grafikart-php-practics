<?php

/*
 * ceil: arrondi au nombre superieur
 * floor: arrondi au nombre inferieur
*/

/*
dump($categories);

# BAD QUERY
$sql = "
SELECT p.*, c.*
FROM post p
LEFT JOIN post_category pc ON pc.id = p.id
LEFT JOIN category c ON c.id = pc.category_id
ORDER BY created_at DESC
LIMIT 12";

# OPTIMIZED
$sql = "
SELECT c.*, pc.post_id
FROM post_category pc
JOIN category c ON c.id = pc.category_id
WHERE pc.post_id IN (6, 50, 42)";
*/

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