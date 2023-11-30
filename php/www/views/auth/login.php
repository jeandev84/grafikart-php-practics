<h1>Se connecter</h1>
<?php if ($forbidden): ?>
<div class="alert alert-danger">
    Vous ne pouvez pas acceder a cette page
</div>
<?php endif; ?>

<form action="<?= $router->url('login') ?>" method="POST">
    <?= $form->input('username', "Nom d' utilisateur") ?>
    <?= $form->input('password', "Mot de passe", 'password') ?>
    <button type="submit" class="btn btn-primary">Se connecter</button>
</form>