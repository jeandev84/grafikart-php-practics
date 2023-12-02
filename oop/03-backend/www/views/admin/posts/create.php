<?php if ($created): ?>
<div class="alert alert-success">
    La categorie a bien ete cree
</div>
<?php endif; ?>
<form action="/admin/category/create" method="POST">
    <?= $form->input('title', "Titre de la categorie") ?>
    <button type="submit" class="btn btn-primary">Sauvegarder</button>
</form>