<?php

require_once('../config/db.php');

if (isset($_POST['submitStop'])) {
    header('Location:deconnexion.php');
}


if(isset($_SESSION['id'])) {

    if (isset($_POST['formmdp'])) {

        if (isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {
            $newmdp1 = sha1($_POST['newmdp1']);
            $newmdp2 = sha1($_POST['newmdp2']);

            if ($newmdp1 == $newmdp2) {
                $insertmdp = $BDD->prepare("UPDATE membres SET motdepasse = ? WHERE id = ?");
                $insertmdp->execute(array($newmdp1, $_SESSION['id']));
                $erreur = "Votre mot de passeà  bien été modifié ! <a href=\"connexion.php\"> Me connecter </a>";
            } else {
                $erreur = "Vos deux mdp ne correspondent pas !";
            }
        }
    }

?>

<?php require 'layout/header.php' ?>

<main>
    <form method="POST" action="">
        <div class="card border-primary mb-3">
            <div class="card-header">Réinitialiser votre mot de passe</div>
            <div class="card-body">
                <p class="card-text">
                    <label class="h5">Mot de passe :</label>
                    <input class="form-input form-control" type="text" name="newmdp1" placeholder="Votre nouveau Mot de passe">
                </p>
                <p class="card-text">
                    <label class="h5">Mot de passe :</label>
                    <input class="form-input form-control" type="text" name="newmdp2" placeholder="Confirmez votre Mot de passe">
                </p>
            </div>
            <br />
            <div align="center">
                <form method="post" action="">
                    <input type="submit" class="btn btn-outline-danger" name="formmdp" value="Enregistrer" />
                    <input name="submitStop" class="btn btn-outline-dark" type="submit" value="Annuler" />
                    <br /><br />
                </form>
            </div>
        </div>
    </form>

<?php
    if(isset($erreur ))
    {
        echo $erreur;
    }
?>

<?php
}
else {
    header("Location: connexion.php");
}
?>

</main>

<?php require 'layout/footer.php' ?>
