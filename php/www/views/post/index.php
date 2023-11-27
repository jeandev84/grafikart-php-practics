<?php

$title = 'Mon Blog';
$request = \Grafikart\Http\Request::createFromGlobals();
$connection = new \Grafikart\Database\Connection\PdoConnection(
     'mysql:dbname=tutoblog;host=127.0.0.1',
'root',
'secret'
);

$repository = new \App\Repository\PostRepository($connection);

$currentPage = $request->queries->getInt('page', 1);

if ($currentPage <= 0) {
    throw new Exception("Numero de page invalide");
}

# ceil: arrondi au nombre superieur
# floor: arrondi au nombre inferieur

$count   = $repository->count();
$perPage = 12;
$pages   = ceil($count / $perPage);

if ($currentPage > $pages) {
    throw new Exception("Cette page n' existe pas");
}

$paginationDto = new \App\DTO\Input\PaginationDto($currentPage, $perPage);
$dto = new \App\DTO\Input\GetPosts($paginationDto);
$posts  = $posts = $repository->findPosts($dto);

?>
<h1>Mon Blog</h1>

<div class="row">
    <?php foreach ($posts as $post): ?>
    <div class="col-md-3">
        <?php require 'card.php'; ?>
    </div>
    <?php endforeach; ?>
</div>