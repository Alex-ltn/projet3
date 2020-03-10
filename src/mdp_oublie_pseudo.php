<?php

require_once('../config/db.php');

if (isset($_POST['formpseudo'])) {
    $pseudomdp = htmlspecialchars($_POST['pseudomdp']);

    if (!empty($pseudomdp)) {
        $requser = $BDD->prepare("SELECT * FROM membres WHERE pseudo = ? ");
        $requser->execute(array($pseudomdp));
        $userexist = $requser->rowCount();;

        if ($userexist == 1) {
            $userinfo = $requser->fetch();
            $_SESSION['id'] = $userinfo['id'];
            $_SESSION['question'] = $userinfo['question'];
            header("Location: mdp_oublie_question.php?id=" . $_SESSION['id']);
        } else {
            $erreur = "Votre pseudo est incorrect !";
        }
    } else {
        $erreur = "Veuillez mettre votre pseudo ! ";
    }
}

if (isset($_POST['submitStop'])) {
    header('Location: connexion.php');
}

?>

<?php require 'layout/header.php' ?>

<main>
    <form method="POST" action="">
        <div class="card border-primary mb-3">
            <div class="card-header">Récupération du nom d'utilisateur</div>
            <div class="card-body">
                <p class="card-title">Pour changer votre mot de passe, veuillez d'abord renseigner votre Pseudo.</p>
                <p class="card-text">
                    <label class="h5">Pseudo :</label>
                    <input class="form-input form-control" type="text" name="pseudomdp" placeholder=" Votre Pseudo">
                </p>
            </div>
        <br />
            <div align="center">
                <form method="post" action="">
                    <input type="submit" class="btn btn-outline-danger" name="formpseudo" value="Suivant" />
                    <input name="submitStop" class="btn btn-outline-dark" type="submit" value="Annuler" />
                    <br /><br />
                </form>
            </div>
    </form>

    <?php
    if(isset($erreur ))
    {
        echo $erreur;
    }
    ?>

</main>

<?php require 'layout/footer.php' ?>