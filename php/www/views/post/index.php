<?php

use Grafikart\Helpers\Text;

$title = 'Mon Blog';
$pdo = new PDO('mysql:dbname=tutoblog;host=127.0.0.1', 'root', 'secret', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$repository = new \App\Repository\PostRepository($pdo);

$currentPage = 1;
$count = $repository->count();
$posts = $posts = $repository->findPosts();
?>
<h1>Mon Blog</h1>

<div class="row">
    <?php foreach ($posts as $post): ?>
    <div class="col-md-3">
        <?php require 'card.php'; ?>
    </div>
    <?php endforeach; ?>
</div>