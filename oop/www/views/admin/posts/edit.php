<form action="/admin/post/<?= $post->id ?>/edit" method="POST">
    <?= $form->input('title', "Titre de l' article") ?>
    <?= $form->textarea('content', "Contenu", ['class' => 'form-control']) ?>
    <button type="submit" class="btn btn-primary">Sauvegarder</button>
</form>