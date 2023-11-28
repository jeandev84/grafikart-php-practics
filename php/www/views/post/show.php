<?php
$parameter = new \Grafikart\Http\Bag\ParameterBag($params);
$id   = $parameter->getInt('id');
$slug = $parameter->get('slug');

$connection = \App\Helpers\Connection::make();
$postRepository = new \App\Repository\PostRepository($connection);
$post = $postRepository->find($id);
$categoryRepository = new \App\Repository\CategoryRepository($connection);
$categoryRepository->hydratePosts([$post]);

if ($post->getSlug() !== $slug) {
    $url = $router->url('post', ['slug' => $post->getSlug(), 'id' => $id]);
    http_response_code(301);
    header("Location: $url");
    exit();
}
?>

<h1><?= e($post->getName()) ?></h1>
<p class="text-muted"><?= $post->getCreatedAt()->format('d F Y') ?></p>
<?php
foreach ($post->getCategories() as $k => $category):
    if ($k > 0):
         echo ', ';
    endif;
    $categoryURL = $router->url('category', ['id' => $category->getId(), 'slug' => $category->getSlug()]);
?>
<a href="<?=  $categoryURL ?>"><?= e($category->getName()) ?></a>
<?php endforeach; ?>
<p><?= $post->getFormattedContent() ?></p>


