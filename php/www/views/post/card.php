<?php
$categories = array_map(function (\App\Entity\Category $category) use ($router) {
    $url = $router->url('category', ['id' => $category->getId(), 'slug' => $category->getSlug()]);
    return sprintf('<a href="%s">%s</a>', $url, $category->getName());
}, $category->getCategories());

?>
<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title"><?= htmlentities($category->getName()) ?></h5>
        <p class="text-muted">
            <?= $category->getCreatedAt()->format('d F Y') ?> ::
            <?php if (! empty($category->getCategories())): ?>
            ::
            <?= implode(', ', $categories) ?>
            <?php endif; ?>
        </p>
        <p><?= $category->getExcerpt() ?></p>
        <p>
            <a href="<?= $router->url('post', ['slug' => $category->getSlug(), 'id' => $category->getId()]) ?>" class="btn btn-primary">Voir plus</a>
        </p>
    </div>
</div>