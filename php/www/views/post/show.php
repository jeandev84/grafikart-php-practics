<?php
$parameter = new \Grafikart\Http\Bag\ParameterBag($params);
$id   = $parameter->getInt('id');
$slug = $parameter->get('slug');

$connection = \App\Helpers\Connection::make();
$postRepository = new \App\Repository\PostRepository($connection);
$item = $postRepository->find($id);
$categoryRepository = new \App\Repository\CategoryRepository($connection);
$categoryRepository->hydratePosts([$item]);

if ($item->getSlug() !== $slug) {
    $url = $router->url('post', ['slug' => $item->getSlug(), 'id' => $id]);
    http_response_code(301);
    header("Location: $url");
    exit();
}
?>

<h1><?= e($item->getName()) ?></h1>
<p class="text-muted"><?= $item->getCreatedAt()->format('d F Y') ?></p>
<?php
foreach ($item->getCategories() as $k => $category):
    if ($k > 0):
         echo ', ';
    endif;
    $categoryURL = $router->url('category', ['id' => $category->getId(), 'slug' => $category->getSlug()]);
?>
<a href="<?=  $categoryURL ?>"><?= e($category->getName()) ?></a>
<?php endforeach; ?>

<?php if ($post->getImage()): ?>
    <img src="<?= $post->getImageUrl('large') ?>" class="card-img-top" alt="<?= $post->getName()?>">
<?php endif; ?>

<p><?= $item->getFormattedContent() ?></p>


