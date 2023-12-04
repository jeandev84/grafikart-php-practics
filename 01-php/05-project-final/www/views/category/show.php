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
$postRepository = new \App\Repository\PostRepository($connection);
[$posts, $paginatedQuery] = $postRepository->findPaginatedForCategory($category->getId());
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