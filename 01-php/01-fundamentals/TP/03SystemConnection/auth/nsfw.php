<?php

// NSFW : NO SAVE FOR WORK
/*
 1. Demander la date de naissance de l' utilisateur select (2010 - 1919)
 2. Persister la date de naissance dans un cookie
 3. Si l' utilisateur est assez-age il pourra lui montrer le contenu
 4. Sinon on affiche un message d' erreur
*/

$age = null;

// on definit le cookie
if (! empty($_POST['birthday'])) {
    setcookie('birthday', $_POST['birthday']);
    $_COOKIE['birthday'] = $_POST['birthday'];
}


// calcul l' age de l' utilisateur
if (! empty($_COOKIE['birthday'])) {
   $birthday = (int) $_COOKIE['birthday'];
   $age      = (int) date('Y') - $birthday; // age de l' utilisateur
}


require 'elements/header.php';
?>


<?php if ($age >= 18): ?>
    <h1>Du contenu reserve aux adultes</h1>
<?php elseif($age !== null): ?>
    <div class="alert alert-danger">Vous n' avez pas l' age requis pour voir le contenu</div>
<?php else: ?>
    <form action="" method="post">
        <div class="form-group">
            <label for="birthday" id="birthday">Section reservee pour les adultes, entrer votre annee de naissance</label>
            <select name="birthday" id="birthday" class="form-control">
                <?php for ($i = 2019; $i > 1919; $i--): ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
<?php endif; ?>


<?php require 'elements/footer.php'; ?>
