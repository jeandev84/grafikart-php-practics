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

# Process 2
$currentPage = \App\Helpers\URL::getPositiveInt('page', 1);
$count       = $categoryRepository->countById($category->getId());
$perPage     = 12;
$pages       = ceil($count / $perPage);

if ($currentPage > $pages) {
    throw new Exception("Cette page n' existe pas");
}

$paginationDto = new \App\DTO\Input\PaginationDto($currentPage, $perPage);
$postRepository = new \App\Repository\PostRepository($connection);
$posts  = $postRepository->findPostsByCategory($paginationDto, $category->getId());
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
    <?php if ($currentPage > 1): ?>
        <?php
        $previousLink = $link;
        if ($currentPage > 2) $previousLink = $link . '?page='. ($currentPage - 1);
        ?>
        <a href="<?= $previousLink ?>" class="btn btn-primary">
            &laquo; Page precedente
        </a>
    <?php endif; ?>

    <?php if ($currentPage < $pages): ?>
        <a href="<?= $link ?>?page=<?= ($currentPage + 1) ?>" class="btn btn-primary ml-auto">
            Page suivante &raquo;
        </a>
    <?php endif; ?>
</div>