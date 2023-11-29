<?php

\App\Security\Auth::check();

$connection = \App\Helpers\Connection::make();
$request    = \Grafikart\Http\Request\Request::createFromGlobals();

$categoryRepository = new \App\Repository\CategoryRepository($connection);
$categories         = $categoryRepository->listCategories();
$postRepository     = new \App\Repository\PostRepository($connection);

/** @var \App\Entity\Post $post */
$post = $postRepository->find($params['id']);
$categoryRepository->hydratePosts([$post]);
$success = false;
$errors = [];

if ($request->isMethod('POST')) {
    $validator = new \App\Validators\PostValidator($request->request->all(), $postRepository, $post->getId());
    \Grafikart\Helpers\ObjectHelper::hydrate($post, $request->request->all(), [
        'name', 'content', 'slug', 'created_at'
    ]);

    if ($validator->validate()) {
        $postRepository->updatePost($post);
        $success = true;
    } else {
        $errors = $validator->errors();
    }
}

$form = new \Grafikart\HTML\Form($post, $errors);
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

<h1>Editer l'article <?= e($post->getName()) ?></h1>

<?php require '_form.php';