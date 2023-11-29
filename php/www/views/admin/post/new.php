<?php

\App\Security\Auth::check();

$request    = \Grafikart\Http\Request\Request::createFromGlobals();
$connection = \App\Helpers\Connection::make();
$errors  = [];
$post    = new \App\Entity\Post();

/*
$post->setName('New article for developer')
     ->setSlug('new-article-for-developer')
     ->setContent('lorem psum ...');

$rc = new ReflectionClass($post);
$data = [];
foreach($rc->getProperties() as $property) {
    $data[$property->getName()] = $property->getValue($post);
}
dd($data);
*/

$categoryRepository = new \App\Repository\CategoryRepository($connection);
$categories = $categoryRepository->list();
$categoryRepository->hydratePosts([$post]);
$post->setCreatedAt(date('Y-m-d H:i:s'));

if ($request->isMethod('POST')) {
    $postRepository = new \App\Repository\PostRepository($connection);
    $data = $request->getParsedBodyWithFiles();
    $validator = new \App\Validators\PostValidator($data, $postRepository, $post->getId(), $categories);
    \Grafikart\Helpers\ObjectHelper::hydrate($post, $data, ['name', 'content', 'slug', 'created_at', 'image']);

    if ($validator->validate()) {
        $pdo = $connection->getPdo();
        $pdo->beginTransaction();
        \App\Attachment\PostAttachment::upload($post);
        $postRepository->createPost($post);
        $postRepository->attachCategories($post->getId(), $request->request->get('category_ids'));
        $pdo->commit();
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