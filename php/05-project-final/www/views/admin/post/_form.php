<form action="" method="POST" enctype="multipart/form-data">
    <?= $form->input('name', 'Titre') ?>
    <?= $form->input('slug', 'URL') ?>
    <div class="row">
        <div class="col-md-8">
            <?= $form->file('image', 'Image a la une') ?>
        </div>
        <div class="col-md-4">
            <?php if ($post->getImage()): ?>
                <img src="<?= $post->getImageUrl('small') ?>" alt="" style="width: 100%;">
            <?php endif; ?>
        </div>
    </div>
    <?= $form->select('category_ids', 'Categories', $categories) ?>
    <?= $form->textarea('content', 'Contenu') ?>
    <?= $form->input('created_at', 'Date de publication') ?>
    <button class="btn btn-primary">
        <?= $post->getId() !== null ? 'Modifier' : 'Creer' ?>
    </button>
</form>

<!---
https://flatpickr.js.org/examples