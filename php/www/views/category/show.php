<?php
$parameter = new \Grafikart\Http\Bag\ParameterBag($params);
$id   = $parameter->getInt('id');
$slug = $parameter->get('slug');

$connection = \App\Helpers\Connection::make();
$categoryRepository = new \App\Repository\CategoryRepository($connection);

$post = $categoryRepository->find($id);

if ($post->getSlug() !== $slug) {
    $url = $router->url('post', ['slug' => $post->getSlug(), 'id' => $id]);
    http_response_code(301);
    header("Location: $url");
    exit();
}
?>
<h1>Ma categorie</h1>