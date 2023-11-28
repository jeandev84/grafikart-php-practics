<?php

use Grafikart\Service\JanValidator;

$connection = \App\Helpers\Connection::make();
$request    = \Grafikart\Http\Request\Request::createFromGlobals();
$postRepository = new \App\Repository\PostRepository($connection);

/** @var \App\Entity\Post $post */
$post = $postRepository->find($params['id']);

$success = false;
$errors = [];

if ($request->isMethod('POST')) {
    \Valitron\Validator::lang('fr');
    $validator = new \App\Validators\PostValidator($request->request->all(), $postRepository);
    $name = $request->request->get('name');
    $post->setName($request->request->get('name'))
         ->setContent($request->request->get('content'))
         ->setSlug($request->request->get('slug'))
         ->setCreatedAt($request->request->get('created_at'));

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
        L' article n'a pas pu etre modifier, merci de corriger vos errors
    </div>
<?php endif; ?>

<h1>Editer l'article <?= e($post->getName()) ?></h1>

<form action="" method="POST">

    <?= $form->input('name', 'Titre') ?>
    <?= $form->input('slug', 'URL') ?>
    <?= $form->textarea('content', 'Contenu') ?>
    <?= $form->input('created_at', 'Date de publication') ?>
    <button class="btn btn-primary">Modifier</button>

</form>

<!---
https://flatpickr.js.org/examples