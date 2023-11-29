<?php
$connection = \App\Helpers\Connection::make();

\App\Security\Auth::check();
$postRepository = new \App\Repository\CategoryRepository($connection);
$postRepository->delete($params['id']);

$url = $router->url('admin.categories') . "?delete=1";
header("Location: $url");
exit;
