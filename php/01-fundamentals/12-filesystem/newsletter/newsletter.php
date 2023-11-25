<?php

/*
 LA NEWSLETTER : est un systeme permettant d' envoyer quotidiennement,
                 ou hebdomadaire des informations (nouvelle promos, achats) a nos utilisateurs/
                 ou d' indiquer des informations a nos utilisateurs
*/

$error   = null;
$email   = null;
$success = null;

// VALIDATION DES DONNES
if (! empty($_POST['email'])) {

    $email = $_POST['email'];

    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $filename = __DIR__.DIRECTORY_SEPARATOR.'emails'.DIRECTORY_SEPARATOR.date('Y-m-d');

        file_put_contents($filename, $email . PHP_EOL, FILE_APPEND);

        $success = "Votre email a bien ete enregister.";

        $email = null;

    } else {
        $error = "Email invalid";
    }
}


// TRAITEMENT DES DONNEES



require 'elements/header.php';
?>


<h1>S' inscrire a la newsletter</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium, perspiciatis?</p>


<?php if ($error): ?>
   <div class="alert alert-danger">
       <?= $error ?>
   </div>
<?php endif; ?>

<?php if ($success): ?>
    <div class="alert alert-success">
        <?= $success ?>
    </div>
<?php endif; ?>

<form action="/newsletter.php" method="POST" class="form-inline">
   <div class="form-group">
       <input type="email" name="email" placeholder="Entrer votre email" class="form-control" value="<?= htmlentities($email) ?>" required>
   </div>
    <button type="submit" class="btn btn-primary">S' inscrire</button>
</form>

<!--
     Exercice Libre:
     on peut definir
     une variable pour dire si on est a la page new letter
     on peut ne doit pas afficher le formulaire du footer
-->

<?php require 'elements/footer.php'; ?>
