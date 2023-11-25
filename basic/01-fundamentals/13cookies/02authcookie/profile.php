<?php

$nom = null;


if (! empty($_GET['action']) && $_GET['action'] === 'disconnect') {
     // supprimer un cookie
     unset($_COOKIE['username']);
     setcookie('username', '', time() - 10);
}


if (! empty($_COOKIE['username'])) {
   $nom  = $_COOKIE['username'];
}

if (! empty($_POST['username'])) {
   // on definit un cookie qui sera valable que pendant la visite de l' utilisateur
   setcookie('username', $_POST['username']);
   $nom = $_POST['username'];
}


require 'elements/header.php';
?>

<?php if ($nom): ?>
    <h1>Bonjour <?= htmlentities($nom) ?></h1>
    <a href="profile.php?action=disconnect">Se deconnecter</a>
<?php else: ?>
    <form action="" method="POST">
        <div class="form-group">
            <input type="text" name="username" class="form-control" placeholder="Entrer votre nom">
        </div>
        <button class="btn btn-primary">Se connecter</button>
    </form>
<?php endif; ?>


<?php require 'elements/footer.php'; ?>
