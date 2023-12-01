<?php if ($success): ?>
<div class="alert alert-success">
    L' article a bien ete modifiee
</div>
<?php endif; ?>

<?php if ($created): ?>
    <div class="alert alert-success">
        L' article a bien ete cree
    </div>
<?php endif; ?>


<?php if ($errors): ?>
    <div class="alert alert-danger">
        L' article n'a pas pu etre modifier, merci de corriger vos errors
    </div>
<?php endif; ?>

<h1>Editer l'article <?= e($post->getName()) ?></h1>

<?php require '_form.php';