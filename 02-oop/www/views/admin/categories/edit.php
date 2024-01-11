<?php if ($updated): ?>
<div class="alert alert-success">
    La categorie a bien ete modifie
</div>
<?php endif; ?>
<form action="<?= $router->generate('admin.category.edit', ['id' => $category->id]) ?>" method="POST">
    <?= $form->input('title', "Titre de la categorie") ?>
    <button type="submit" class="btn btn-primary">Sauvegarder</button>
</form>