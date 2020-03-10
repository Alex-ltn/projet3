<?php

require_once('../config/db.php');

if (isset($_POST['formconnect']))
{
    $pseudoconnect = htmlspecialchars($_POST['pseudoconnect']);
    $mdpconnect = sha1($_POST['mdpconnect']);

    if (!empty($pseudoconnect) AND !empty($mdpconnect))
    {
        $requser = $BDD->prepare("SELECT * FROM membres WHERE pseudo = ? AND motdepasse = ?");
        $requser->execute(array($pseudoconnect, $mdpconnect));
        $userexist = $requser->rowCount();


        if ($userexist == 1)
        {
            $userinfo = $requser->fetch();
            $_SESSION['id'] = $userinfo['id'];
            $_SESSION['pseudo'] = $userinfo['pseudo'];
            $_SESSION['mail'] = $userinfo['mail'];
            header("Location: acteurs.php?id=".$_SESSION['id']);
        }

        else
        {
            $erreur = "Pseudo et/ou Mot de passe incorrect(s)";
        }
    }

    else
    {
         $erreur = "tous les champs doivent être complétés !";
    }
}

if (isset($_POST['submitReg'])) {
    header('Location: inscription.php');
}

?>

<?php require 'layout/header.php' ?>

<main>
<form method="POST" action="">
    <div class="card border-primary mb-3">
        <div class="card-header">Connexion</div>
            <div class="card-body">
                <p class="card-title">Pour accéder aux information du site, renseignez votre Pseudo et votre Mot de passe</p>
                <p class="card-text">
                    <label class="h5">Pseudo :</label>
                    <input class="form-input form-control" type="text" name="pseudoconnect" placeholder=" Votre Pseudo" required>
                </p>
                <p class="card-text">
                    <label class="h5">Mot de passe :</label>
                    <input class="form-input form-control" type="password" name="mdpconnect" placeholder=" Votre Mot de passe" required>
                </p>
            </div>
            <div align="center">
                <form method="post" action="">
                    <input type="submit" name="formconnect" class="btn btn-outline-danger" value="Se connecter">
                </form>
            </div>
            <a class="btn btn-link" href="mdp_oublie_pseudo.php">Vous avez oublié votre mot de passe ?</a>
        <?php
        if(isset($erreur ))
        {
            echo $erreur;
        }
        ?>
    </div>
</form>

<div class="card border-primary mb-3">
    <div class="card-header">Première visite sur ce site ?</div>
    <div class="card-body">
        <p class="card-title">Pour vous connecter, veuillez vous créer un compte !</p>
    </div>
    <div align="center">
        <form method="post" action="">
            <input type="submit" name="submitReg" class="btn btn-outline-danger" value="S'inscire">
        </form>
        <br />
    </div>
</div>
</main>

<?php require 'layout/footer.php' ?>