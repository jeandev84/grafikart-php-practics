<?php if ($success): ?>
<div class="alert alert-success">
    La categorie a bien ete modifiee
</div>
<?php endif; ?>

<?php if ($created): ?>
    <div class="alert alert-success">
        La categorie a bien ete cree
    </div>
<?php endif; ?>

<?php if ($errors): ?>
    <div class="alert alert-danger">
        La categorie n'a pas pu etre modifier, merci de corriger vos errors
    </div>
<?php endif; ?>

<h1>Editer la categorie <?= e($category->getName()) ?></h1>

<?php require '_form.php';