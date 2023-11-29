<?php
$connection = \App\Helpers\Connection::make();

\App\Security\Auth::check();
$repository = new \App\Repository\PostRepository($connection);
$repository->delete($params['id']);

$url = $router->url('admin.posts') . "?delete=1";
header("Location: $url");
exit;
