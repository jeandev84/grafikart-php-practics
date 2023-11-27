<?php
$parameter = new \Grafikart\Http\Bag\ParameterBag($params);
$id   = $parameter->getInt('id');
$slug = $parameter->get('slug');

$connection = \App\Helpers\Connection::make();
$repository = new \App\Repository\PostRepository($connection);

$post = $repository->find($id);

dd($post);
?>


