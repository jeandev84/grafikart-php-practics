<?php
\App\Security\Auth::check();
$connection = \App\Helpers\Connection::make();
$postId = $params['id'];

$repository = new \App\Repository\PostRepository($connection);
if($post = $repository->find($postId)) {
    \App\Attachment\PostAttachment::detach($post);
}
$repository->delete($postId);
$url = $router->url('admin.posts') . "?delete=1";
header("Location: $url");
exit;
