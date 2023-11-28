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
    $validator = new JanValidator($request->request->all(), 'fr');

    $validator->labels([
        'name' => 'Titre',
        'Contenu' => 'Contenu'
    ]);
    $validator->rule('required', ['name', 'slug']);
    $validator->rule('lengthBetween', ['name', 'slug'], 3, 200);
    $name = $request->request->get('name');
    $post->setName($request->request->get('name'));
         //->setContent($request->request->get('content'));

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

    <button class="btn btn-primary">Modifier</button>
</form>