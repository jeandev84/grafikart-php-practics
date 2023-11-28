<?php

$connection = \App\Helpers\Connection::make();
$request    = \Grafikart\Http\Request\Request::createFromGlobals();
$postRepository = new \App\Repository\PostRepository($connection);

/** @var \App\Entity\Post $post */
$post = $postRepository->find($params['id']);

$success = false;
$errors = [];

if ($request->isMethod('POST')) {
    \Valitron\Validator::lang('fr');
    $validator = new \Valitron\Validator($request->request->all());
    $validator->labels([
        'name' => 'Titre',
        'Contenu' => 'Contenu'
    ]);
    $validator->rule('required', 'name');
    $validator->rule('lengthBetween', 'name', 3, 200);
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
    <div class="form-group">
        <label for="name">Titre</label>
        <input type="text" class="form-control <?= isset($errors['name']) ? 'is-invalid': '' ?>" name="name" value="<?= e($post->getName()) ?>">
        <?php if ($errors): ?>
            <div class="invalid-feedback">
                <?= join("<br>", $errors['name']) ?>
            </div>
        <?php endif; ?>
    </div>
    <button class="btn btn-primary">Modifier</button>
</form>