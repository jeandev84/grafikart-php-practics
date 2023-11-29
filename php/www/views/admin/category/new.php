<?php

\App\Security\Auth::check();
$request    = \Grafikart\Http\Request\Request::createFromGlobals();

$errors  = [];
$post    = new \App\Entity\Post();
$post->setCreatedAt(date('Y-m-d H:i:s'));

if ($request->isMethod('POST')) {
    $connection = \App\Helpers\Connection::make();
    $postRepository = new \App\Repository\PostRepository($connection);

    $validator = new \App\Validators\PostValidator($request->request->all(), $postRepository, $post->getId());
    \Grafikart\Helpers\ObjectHelper::hydrate($post, $request->request->all(), [
        'name', 'content', 'slug', 'created_at'
    ]);

    if ($validator->validate()) {
        $postRepository->create($post);
        header('Location: '. $router->url('admin.post', ['id' => $post->getId()]) . '?created=1');
        exit;
    } else {
        $errors = $validator->errors();
    }
}

$form = new \Grafikart\HTML\Form($post, $errors);
?>

<?php if ($errors): ?>
    <div class="alert alert-danger">
        L' article n'a pas pu etre enregistre, merci de corriger vos errors
    </div>
<?php endif; ?>

<h1>Creer un article</h1>

<?php require '_form.php';