<?php foreach ($posts as $post): ?>
   <h2>
       <a href="<?= $post->url ?>">
           <?= $post->title ?>
       </a>
   </h2>
   <p><?= $post->excerpt ?></p>
<?php endforeach; ?>


