<?php if ($incorrect): ?>
   <div class="alert alert-danger">
       Identifiant inccorrect
   </div>
<?php endif; ?>
<h1>Se connecter</h1>

<form action="/login" method="POST">
    <?= $form->input('username', 'Pseudo') ?>
    <?= $form->input('password', 'Mot de passe', ['type' => 'password']) ?>
    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>