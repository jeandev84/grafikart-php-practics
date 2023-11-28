<?php


\App\Security\Auth::check();

$title = "Administration";
$connection = \App\Helpers\Connection::make();
$request    = \Grafikart\Http\Request\Request::createFromGlobals();
$postRepository = new \App\Repository\PostRepository($connection);
[$posts, $pagination] = $postRepository->findPaginated();
$link = $router->url('admin.posts');
?>

<?php if ($request->queries->has('delete')): ?>
<div class="alert alert-success">
    L' enregistrement a bien ete supprime
</div>
<?php endif; ?>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Titre</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
       <?php foreach ($posts as $post): ?>
        <tr>
            <td>#<?= $post->getId() ?></td>
            <td>
                <a href="<?= $router->url('admin.post', ['id' => $post->getId()]) ?>">
                    <?= e($post->getName()) ?>
                </a>
            </td>
            <td>
                <a href="<?= $router->url('admin.post', ['id' => $post->getId()]) ?>" class="btn btn-primary">
                    Editer
                </a>
                <a href="<?= $router->url('admin.post.delete', ['id' => $post->getId()]) ?>" class="btn btn-danger"
                  onclick="return confirm('Voulez-vous vraiment effectuee cette action')">
                    Supprimer
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="d-flex justify-content-between my-4">
    <?= $pagination->previousLink($link) ?>
    <?= $pagination->nextLink($link) ?>
</div>


