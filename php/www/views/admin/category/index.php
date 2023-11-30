<?php if ($delete): ?>
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
       <?php foreach ($categories as $category): ?>
        <tr>
            <td>#<?= $category->getId() ?></td>
            <td>
                <a href="<?= $router->url('admin.category', ['id' => $category->getId()]) ?>">
                    <?= e($category->getName()) ?>
                </a>
            </td>
            <td><?= $category->getSlug() ?></td>
            <td>
                <a href="<?= $router->url('admin.category', ['id' => $category->getId()]) ?>" class="btn btn-primary">
                    Editer
                </a>
                <form action="<?= $router->url('admin.category.delete', ['id' => $category->getId()]) ?>"
                      method="POST"
                      onsubmit="return confirm('Voulez-vous vraiment effectuee cette action')" style="display: inline;">
                       <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>


