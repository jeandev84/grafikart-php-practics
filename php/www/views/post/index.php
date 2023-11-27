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
        <?php require 'card.php'; ?>
    </div>
    <?php endforeach; ?>
</div>