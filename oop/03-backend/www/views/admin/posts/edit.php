<?php if ($updated): ?>
<div class="alert alert-success">
    L' article a bien ete modifie
</div>
<?php endif; ?>
<form action="<?= $router->generate('admin.post.edit', ['id' => $post->id]) ?>" method="POST">
    <?= $form->input('title', "Titre de l' article") ?>
    <?= $form->textarea('content', "Contenu", ['class' => 'form-control']) ?>
    <?= $form->select('category_id', "Category", $categories, ['class' => 'form-control']) ?>
    <button type="submit" class="btn btn-primary">Sauvegarder</button>
</form>