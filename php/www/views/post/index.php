<?php

use Grafikart\Helpers\Text;

$title = 'Mon Blog';
$pdo = new PDO('mysql:dbname=tutoblog;host=127.0.0.1', 'root', 'secret', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);
$query = $pdo->query("SELECT * FROM post ORDER BY created_at DESC LIMIT 12");

/** @var \App\Entity\Post[] $posts */
$posts = $query->fetchAll(PDO::FETCH_CLASS, \App\Entity\Post::class);
?>
<h1>Mon Blog</h1>

<div class="row">
    <?php foreach ($posts as $post): ?>
    <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlentities($post->getName()) ?></h5>
                    <p class="text-muted"><?= $post->getCreatedAt()->format('d F Y') ?></p>
                    <p><?= $post->getExcerpt() ?></p>
                    <p>
                        <a href="<?= $router->url('post', ['slug' => $post->getSlug(), 'id' => $post->getId()]) ?>" class="btn btn-primary">Voir plus</a>
                    </p>
                </div>
            </div>
    </div>
    <?php endforeach; ?>
</div>