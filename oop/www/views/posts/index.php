<?php foreach ($posts as $post): ?>
   <h2><a href="<?= $post->getUrl() ?>"></a></h2>
   <p><?= $post->getExcerpt() ?></p>
<?php endforeach; ?>
