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

$paginatedQuery = new \App\Helpers\PaginatedQuery(
   "SELECT * FROM post ORDER BY created_at DESC",
"SELECT COUNT(id) FROM post"
);

/** @var \App\Entity\Post[] $posts */
$posts   = $paginatedQuery->getItems(\App\Entity\Post::class);
$postsById = [];
foreach ($posts as $post) {
    $postsById[$post->getId()] = $post;
}

$categoryRepository = new \App\Repository\CategoryRepository($connection);
$categories = $categoryRepository->findByPostIds(array_keys($postsById));

# On parcourt les categories

# On trouve l' article $posts correspondant a la ligne

# On  ajoute la categorie a l' article


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