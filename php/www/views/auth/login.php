<?php

$request = \Grafikart\Http\Request\Request::createFromGlobals();

$user = new \App\Entity\User();
$errors = [];

if ($request->isMethod('POST')) {
   $username = $request->request->get('username');
   $password = $request->request->get('password');
   $user->setUsername($username);

   if (! $username || ! $password) {
       $errors['password'] = "Identifiant ou mot de passe incorrect";
   }
}

$form = new \Grafikart\HTML\Form($user, $errors);
?>
<h1>Se connecter</h1>

<form action="" method="POST">
    <?= $form->input('username', "Nom d' utilisateur") ?>
    <?= $form->input('password', "Mot de passe", 'password') ?>
    <button type="submit" class="btn btn-primary">Se connecter</button>
</form>