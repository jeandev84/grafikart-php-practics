<?php
$categories = array_map(function (\App\Entity\Category $category) use ($router) {
    $url = $router->url('category', ['id' => $category->getId(), 'slug' => $category->getSlug()]);
    return sprintf('<a href="%s">%s</a>', $url, $category->getName());
}, $item->getCategories());

?>
<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title"><?= htmlentities($item->getName()) ?></h5>
        <p class="text-muted">
            <?= $item->getCreatedAt()->format('d F Y') ?> ::
            <?php if (! empty($item->getCategories())): ?>
            ::
            <?= implode(', ', $categories) ?>
            <?php endif; ?>
        </p>
        <p><?= $item->getExcerpt() ?></p>
        <p>
            <a href="<?= $router->url('post', ['slug' => $item->getSlug(), 'id' => $item->getId()]) ?>" class="btn btn-primary">Voir plus</a>
        </p>
    </div>
</div>