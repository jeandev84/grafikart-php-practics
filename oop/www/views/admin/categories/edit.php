<?php if ($updated): ?>
<div class="alert alert-success">
    La categorie a bien ete modifie
</div>
<?php endif; ?>
<form action="/admin/category/<?= $category->id ?>/edit" method="POST">
    <?= $form->input('title', "Titre de la categorie") ?>
    <button type="submit" class="btn btn-primary">Sauvegarder</button>
</form>