<?php

use Grafikart\Database\ORM\Persistence\Repository\Exception\NotFoundException;

$request = \Grafikart\Http\Request\Request::createFromGlobals();

$user = new \App\Entity\User();
$errors = [];

if ($request->isMethod('POST')) {

    try {

        $username = $request->request->get('username');
        $password = $request->request->get('password');
        $user->setUsername($username);
        $errors['password'] = "Identifiant ou mot de passe incorrect";

        if (! $username || !$password) {
            throw new Exception("Identifiant ou mot de passe incorrect");
        }

        $connection = \App\Helpers\Connection::make();
        $repository = new \App\Repository\UserRepository($connection);
        $u = $repository->findByUsername($username);
        $hashedPassword = $u->getPassword();

        if(password_verify($password, $hashedPassword)) {
            header("Location: ". $router->url('admin.posts'));
        }

    } catch (Exception $exception) {
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