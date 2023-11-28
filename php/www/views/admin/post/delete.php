<?php
$connection = \App\Helpers\Connection::make();

\App\Security\Auth::check();
$postRepository = new \App\Repository\PostRepository($connection);
$postRepository->delete($params['id']);

$url = $router->url('admin.posts') . "?delete=1";
header("Location: $url");
exit;
