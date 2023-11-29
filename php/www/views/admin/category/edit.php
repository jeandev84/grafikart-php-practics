<?php

\App\Security\Auth::check();

$connection = \App\Helpers\Connection::make();
$request    = \Grafikart\Http\Request\Request::createFromGlobals();
$repository = new \App\Repository\CategoryRepository($connection);

/** @var \App\Entity\Category $category */
$category = $repository->find($params['id']);

$success = false;
$errors = [];
$fields = ['name', 'content', 'slug', 'created_at'];

if ($request->isMethod('POST')) {
    $validator = new \App\Validators\CategoryValidator($request->request->all(), $repository, $category->getId());
    \Grafikart\Helpers\ObjectHelper::hydrate($category, $request->request->all(), $fields);

    if ($validator->validate()) {
        $repository->update($category);
        $success = true;
    } else {
        $errors = $validator->errors();
    }
}

$form = new \Grafikart\HTML\Form($category, $errors);
?>

<?php if ($success): ?>
<div class="alert alert-success">
    L' article a bien ete modifiee
</div>
<?php endif; ?>

<?php if ($request->queries->has('created')): ?>
    <div class="alert alert-success">
        L' article a bien ete cree
    </div>
<?php endif; ?>


<?php if ($errors): ?>
    <div class="alert alert-danger">
        L' article n'a pas pu etre modifier, merci de corriger vos errors
    </div>
<?php endif; ?>

<h1>Editer l'article <?= e($category->getName()) ?></h1>

<?php require '_form.php';