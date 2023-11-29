<?php
$categories = array_map(function (\App\Entity\Category $category) use ($router) {
    $url = $router->url('category', ['id' => $category->getId(), 'slug' => $category->getSlug()]);
    return sprintf('<a href="%s">%s</a>', $url, $category->getName());
}, $post->getCategories());

?>
<div class="card mb-3">
    <?php if ($post->getImage()): ?>
        <img src="<?= $post->getImageUrl('small') ?>" class="card-img-top" alt="<?= $post->getName()?>">
    <?php endif; ?>
    <div class="card-body">
        <h5 class="card-title"><?= htmlentities($post->getName()) ?></h5>
        <p class="text-muted">
            <?= $post->getCreatedAt()->format('d F Y') ?> ::
            <?php if (! empty($post->getCategories())): ?>
            ::
            <?= implode(', ', $categories) ?>
            <?php endif; ?>
        </p>
        <p><?= $post->getExcerpt() ?></p>
        <p>
            <a href="<?= $router->url('post', ['slug' => $post->getSlug(), 'id' => $post->getId()]) ?>" class="btn btn-primary">Voir plus</a>
        </p>
    </div>
</div>