<?php

# Process 1
$parameter = new \Grafikart\Http\Bag\ParameterBag($params);
$id   = $parameter->getInt('id');
$slug = $parameter->get('slug');

$connection = \App\Helpers\Connection::make();
$categoryRepository = new \App\Repository\CategoryRepository($connection);

$category = $categoryRepository->find($id);

if ($category->getSlug() !== $slug) {
    $url = $router->url('category', ['slug' => $category->getSlug(), 'id' => $id]);
    http_response_code(301);
    header("Location: $url");
    exit();
}

$title = "Categorie {$category->getName()}";


/**
 * Parametre varie:
 * $sqlListing: string
 * $classMapping: string
 * $sqlCount: string
 *  $pdo: PDO
 * $perPage: int = 12
 *
 * Parametre externes:
 * //$currentPage
 * $pdo
 *
 *
 * Methodes:
 * getItems(): array
 * getPreviousPageLink(); ?string
 * HasPreviousPageLink(); bool
 * getNextPageLink(): ?string
 * HasNextPageLink(): bool
 *
*/

$categoryId = $category->getId();
$paginatedQuery = new \App\Helpers\PaginatedQuery(
     "SELECT p.* 
            FROM post p 
            JOIN post_category pc ON pc.post_id = p.id
            WHERE pc.category_id = {$categoryId}
            ORDER BY created_at DESC",
"SELECT COUNT(category_id) FROM post_category WHERE category_id = {$categoryId}"
);

/** @var \App\Post[] $posts */
$posts  = $paginatedQuery->getItems(\App\Entity\Post::class);

$link   = $router->url('category', ['id' => $category->getId(), 'slug' => $category->getSlug()])

?>

<h1><?= e($title) ?></h1>

<div class="row">
    <?php foreach ($posts as $post): ?>
        <div class="col-md-3">
            <?php require dirname(__DIR__).'/post/card.php'; ?>
        </div>
    <?php endforeach; ?>
</div>

<div class="d-flex justify-content-between my-4">
    <?= $paginatedQuery->previousLink($link) ?>
    <?= $paginatedQuery->nextLink($link) ?>
</div>