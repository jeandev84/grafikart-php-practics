<?php

\App\Security\Auth::check();
$request    = \Grafikart\Http\Request\Request::createFromGlobals();

$errors  = [];
$item    = new \App\Entity\Category();
$fields = ['name', 'slug'];

if ($request->isMethod('POST')) {
    $connection = \App\Helpers\Connection::make();
    $repository = new \App\Repository\CategoryRepository($connection);

    $validator = new \App\Validators\CategoryValidator($request->request->all(), $repository);
    \Grafikart\Helpers\ObjectHelper::hydrate($item, $request->request->all(), $fields);

    if ($validator->validate()) {
        $repository->create([
            'name' => $item->getName(),
            'slug' => $item->getSlug()
        ]);
        header('Location: '. $router->url('admin.categories') . '?created=1');
        exit;
    } else {
        $errors = $validator->errors();
    }
}

$form = new \Grafikart\HTML\Form($item, $errors);
?>

<?php if ($errors): ?>
    <div class="alert alert-danger">
        La categorie n'a pas pu etre enregistre, merci de corriger vos errors
    </div>
<?php endif; ?>

<h1>Creer une categorie</h1>

<?php require '_form.php';