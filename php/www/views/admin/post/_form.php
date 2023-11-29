<form action="" method="POST">
    <?= $form->input('name', 'Titre') ?>
    <?= $form->input('slug', 'URL') ?>
    <?= $form->textarea('content', 'Contenu') ?>
    <?= $form->input('created_at', 'Date de publication') ?>
    <button class="btn btn-primary">
        <?= $item->getId() !== null ? 'Modifier' : 'Creer' ?>
    </button>
</form>

<!---
https://flatpickr.js.org/examples