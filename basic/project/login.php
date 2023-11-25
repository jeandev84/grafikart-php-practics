<?php

$error = null;

/* $hash = password_hash('Doe', PASSWORD_DEFAULT, ['cost' => 12]); */

$passwordHashed = '$2y$12$GWF1tI6kr7DqsyqzrZFURePra54i.TZFmHaCR4TjzbUNrCBz4eRhC';

if (! empty($_POST['pseudo']) && ! empty($_POST['password'])) {

    if ($_POST['pseudo'] === 'John' && password_verify($_POST['password'], $passwordHashed)) {

        session_start();
        $_SESSION['connected'] = 1;
        header('Location: /dashboard.php');
        exit();

    } else {
        $error = "Identifiants incorrects";
    }
}


require_once 'functions/auth.php';

if (is_connected()) {
    header('Location: /dashboard.php');
    exit();
}

require_once 'elements/header.php';
?>

<h1>Login</h1>

<?php if($error): ?>
 <div class="alert alert-danger">
     <?= $error ?>
 </div>
<?php endif; ?>
<form action="" method="post">
    <div class="form-group">
        <input type="text" name="pseudo" placeholder="Nom d' utilisateur" class="form-control">
    </div>
    <div class="form-group">
        <input type="password" name="password"  placeholder="Votre mot de passe" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Se connecter</button>
</form>
<?php require_once 'elements/footer.php'; ?>

