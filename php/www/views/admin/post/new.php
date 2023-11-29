<?php

\App\Security\Auth::check();

$request    = \Grafikart\Http\Request\Request::createFromGlobals();

$errors  = [];
$item    = new \App\Entity\Post();
$item->setCreatedAt(date('Y-m-d H:i:s'));
$fields = ['name', 'content', 'slug', 'created_at'];

if ($request->isMethod('POST')) {
    $connection = \App\Helpers\Connection::make();
    $repository = new \App\Repository\PostRepository($connection);

    $validator = new \App\Validators\PostValidator($request->request->all(), $repository, $item->getId());
    \Grafikart\Helpers\ObjectHelper::hydrate($item, $request->request->all(), $fields);

    if ($validator->validate()) {
        $repository->create($item);
        header('Location: '. $router->url('admin.post', ['id' => $item->getId()]) . '?created=1');
        exit;
    } else {
        $errors = $validator->errors();
    }
}

$form = new \Grafikart\HTML\Form($item, $errors);
?>

<?php if ($errors): ?>
    <div class="alert alert-danger">
        L' article n'a pas pu etre enregistre, merci de corriger vos errors
    </div>
<?php endif; ?>

<h1>Creer un article</h1>

<?php require '_form.php';