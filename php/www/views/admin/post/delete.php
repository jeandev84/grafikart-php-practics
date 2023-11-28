<?php
$connection = \App\Helpers\Connection::make();

$postRepository = new \App\Repository\PostRepository($connection);
$postRepository->delete($params['id']);

$url = $router->url('admin_posts');
header("Location: $url");
exit;
