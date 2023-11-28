<?php

$connection = \App\Helpers\Connection::make();
$request    = \Grafikart\Http\Request\Request::createFromGlobals();
$postRepository = new \App\Repository\PostRepository($connection);

/** @var \App\Entity\Post $post */
$post = $postRepository->find($params['id']);

$success = false;

if ($request->isMethod('POST')) {
    $post->setName($request->request->get('name'))
         ->setContent($request->request->get('content'));

    $postRepository->update($post);
    $success = true;
}

?>

<?php if ($success): ?>
<div class="alert alert-success">
    L' article a bien ete modifiee
</div>
<?php endif; ?>

<h1>Editer l'article <?= e($post->getName()) ?></h1>


<form action="" method="POST">
    <div class="form-group">
        <label for="name">Titre</label>
        <input type="text" class="form-control" name="name" value="<?= e($post->getName()) ?>">
    </div>
    <button class="btn btn-primary">Modifier</button>
</form>