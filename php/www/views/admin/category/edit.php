<?php

\App\Security\Auth::check();

$connection = \App\Helpers\Connection::make();
$request    = \Grafikart\Http\Request\Request::createFromGlobals();
$repository = new \App\Repository\CategoryRepository($connection);

/** @var \App\Entity\Category $item */
$item = $repository->find($params['id']);

$success = false;
$errors = [];
$fields = ['name', 'slug'];

if ($request->isMethod('POST')) {
    $validator = new \App\Validators\CategoryValidator($request->request->all(), $repository, $item->getId());
    \Grafikart\Helpers\ObjectHelper::hydrate($item, $request->request->all(), $fields);

    if ($validator->validate()) {
        $repository->update([
            'name' => $item->getName(),
            'slug' => $item->getSlug()
        ], $item->getId());
        $success = true;
    } else {
        $errors = $validator->errors();
    }
}

$form = new \Grafikart\HTML\Form($item, $errors);
?>

<?php if ($success): ?>
<div class="alert alert-success">
    La categorie a bien ete modifiee
</div>
<?php endif; ?>

<?php if ($request->queries->has('created')): ?>
    <div class="alert alert-success">
        La categorie a bien ete cree
    </div>
<?php endif; ?>


<?php if ($errors): ?>
    <div class="alert alert-danger">
        La categorie n'a pas pu etre modifier, merci de corriger vos errors
    </div>
<?php endif; ?>

<h1>Editer la categorie <?= e($item->getName()) ?></h1>

<?php require '_form.php';