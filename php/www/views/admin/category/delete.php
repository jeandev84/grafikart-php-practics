<?php
$connection = \App\Helpers\Connection::make();

\App\Security\Auth::check();
$repository = new \App\Repository\CategoryRepository($connection);
$repository->delete($params['id']);

$url = $router->url('admin.categories') . "?delete=1";
header("Location: $url");
exit;
