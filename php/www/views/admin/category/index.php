<?php

\App\Security\Auth::check();

$title = "Gestion des categories";
$connection = \App\Helpers\Connection::make();
$request    = \Grafikart\Http\Request\Request::createFromGlobals();
$repository = new \App\Repository\CategoryRepository($connection);
$items  = $repository->findAll();
$link = $router->url('admin.categories');
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
            <th>URL</th>
            <th><a href="<?= $router->url('admin.category.new') ?>" class="btn btn-primary">Nouveau</a></th>
        </tr>
    </thead>
    <tbody>
       <?php foreach ($items as $item): ?>
        <tr>
            <td>#<?= $item->getId() ?></td>
            <td>
                <a href="<?= $router->url('admin.category', ['id' => $item->getId()]) ?>">
                    <?= e($item->getName()) ?>
                </a>
            </td>
            <td><?= $item->getSlug() ?></td>
            <td>
                <a href="<?= $router->url('admin.category', ['id' => $item->getId()]) ?>" class="btn btn-primary">
                    Editer
                </a>
                <form action="<?= $router->url('admin.category.delete', ['id' => $item->getId()]) ?>"
                      method="POST"
                      onsubmit="return confirm('Voulez-vous vraiment effectuee cette action')" style="display: inline;">
                       <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>


