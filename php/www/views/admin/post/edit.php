<?php

$connection = \App\Helpers\Connection::make();
$postRepository = new \App\Repository\PostRepository($connection);
$post = $postRepository->find($params['id']);
?>

<h1>Editer l'article <?= e($post->getName()) ?></h1>


<form action="" method="POST">
    <div class="form-group">
        <label for="name">Titre</label>
        <input type="text" class="form-control" name="name" value="<?= e($post->getName()) ?>">
    </div>
    <button class="btn btn-primary">Modifier</button>
</form>