<?php

\App\Security\Auth::check();

# $router->layout = "admin/layouts/default";
$title = "Administration";
$connection = \App\Helpers\Connection::make();
$request    = \Grafikart\Http\Request\Request::createFromGlobals();
$repository = new \App\Repository\PostRepository($connection);
[$items, $pagination] = $repository->findPaginated();
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
            <th><a href="<?= $router->url('admin.post.new') ?>" class="btn btn-primary">Nouveau</a></th>
        </tr>
    </thead>
    <tbody>
       <?php foreach ($items as $item): ?>
        <tr>
            <td>#<?= $item->getId() ?></td>
            <td>
                <a href="<?= $router->url('admin.post', ['id' => $item->getId()]) ?>">
                    <?= e($item->getName()) ?>
                </a>
            </td>
            <td>
                <a href="<?= $router->url('admin.post', ['id' => $item->getId()]) ?>" class="btn btn-primary">
                    Editer
                </a>
                <form action="<?= $router->url('admin.post.delete', ['id' => $item->getId()]) ?>"
                      method="POST"
                      onsubmit="return confirm('Voulez-vous vraiment effectuee cette action')" style="display: inline;">
                       <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="d-flex justify-content-between my-4">
    <?= $pagination->previousLink($link) ?>
    <?= $pagination->nextLink($link) ?>
</div>


