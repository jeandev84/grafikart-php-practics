<?php

use Grafikart\Service\JanValidator;
$request    = \Grafikart\Http\Request\Request::createFromGlobals();

$success = false;
$errors  = [];
$post    = new \App\Entity\Post();

if ($request->isMethod('POST')) {
    $connection = \App\Helpers\Connection::make();
    $postRepository = new \App\Repository\PostRepository($connection);
    $validator = new \App\Validators\PostValidator($request->request->all(), $postRepository, $post->getId());
    \Grafikart\Helpers\ObjectHelper::hydrate($post, $request->request->all(), [
        'name', 'content', 'slug', 'created_at'
    ]);

    if ($validator->validate()) {
        $postRepository->update($post);
        $success = true;
    } else {
        $errors = $validator->errors();
    }
}

$form = new \Grafikart\HTML\Form\Form($post, $errors);
?>

<?php if ($success): ?>
    <div class="alert alert-success">
        L' article a bien ete modifiee
    </div>
<?php endif; ?>

<?php if ($errors): ?>
    <div class="alert alert-danger">
        L' article n'a pas pu etre enregistre, merci de corriger vos errors
    </div>
<?php endif; ?>

<h1>Creer un article</h1>

<?php require '_form.php';