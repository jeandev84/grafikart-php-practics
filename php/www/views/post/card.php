<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title"><?= htmlentities($post->getName()) ?></h5>
        <p class="text-muted">
            <?= $post->getCreatedAt()->format('d F Y') ?> ::
            <?php
            foreach ($post->getCategories() as $k => $category):
                if ($k > 0):
                    echo ', ';
                endif;
                $categoryURL = $router->url('category', ['id' => $category->getId(), 'slug' => $category->getSlug()]);
                ?>
                <a href="<?=  $categoryURL ?>"><?= e($category->getName()) ?></a>
            <?php endforeach; ?>
        </p>
        <p><?= $post->getExcerpt() ?></p>
        <p>
            <a href="<?= $router->url('post', ['slug' => $post->getSlug(), 'id' => $post->getId()]) ?>" class="btn btn-primary">Voir plus</a>
        </p>
    </div>
</div>