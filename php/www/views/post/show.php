<h1><?= e($post->getName()) ?></h1>
<p class="text-muted"><?= $post->getCreatedAt()->format('d F Y') ?></p>
<?php
foreach ($post->getCategories() as $k => $category):
    if ($k > 0):
         echo ', ';
    endif;
    $categoryURL = $router->url('category', ['id' => $category->getId(), 'slug' => $category->getSlug()]);
?>
<a href="<?=  $categoryURL ?>"><?= e($category->getName()) ?></a>
<?php endforeach; ?>

<?php if ($post->getImage()): ?>
    <p>
        <img src="<?= $post->getImageUrl('large') ?>" alt="<?= $post->getName()?>" style="width: 100%;">
    </p>
<?php endif; ?>

<p><?= $post->getFormattedContent() ?></p>


