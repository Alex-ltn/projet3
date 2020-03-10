<?php

require_once('../config/db.php');

if (isset($_POST['submitBackButton'])) {
    header('Location: connexion.php');
}

if(isset($_POST['forminscription']))
{
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $mail = htmlspecialchars($_POST['mail']);
    $mdp = sha1($_POST['mdp']);                     /*chiffer mdp */
    $mdp2 = sha1($_POST['mdp2']);                   /* chiffrer mdp */
    $prenom = htmlspecialchars($_POST['prenom']);
    $nom = htmlspecialchars($_POST['nom']);
    $question = htmlspecialchars($_POST['question']);
    $reponse = htmlspecialchars($_POST['reponse']);

    if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']) AND !empty($_POST['prenom']) AND !empty($_POST['nom']) AND !empty($_POST['reponse']))
    {
        $prenomlenght = strlen($prenom);
        if ($prenom <= 255) {
            $nomlenght = strlen($nom);
            if ($nom <= 255) {
                $pseuolength = strlen($pseudo);
                if ($pseudo <= 255) {

                    $reqpseudo = $BDD->prepare("SELECT * FROM membres WHERE pseudo = ?");       /* pour savoir si mail déjà utilisée */
                    $reqpseudo->execute(array($pseudo));
                    $pseudoexist = $reqpseudo->rowCount();
                    if ($pseudoexist == 0) {

                        if (filter_var($mail, FILTER_VALIDATE_EMAIL))        /* adresse mail valide (protection) */ {

                            $reqmail = $BDD->prepare("SELECT * FROM membres WHERE mail = ?");       /* pour savoir si mail déjà utilisée */
                            $reqmail->execute(array($mail));
                            $mailexist = $reqmail->rowCount();
                            if ($mailexist == 0) {

                                if ($mdp == $mdp2) {
                                    $insertmbr = $BDD->prepare("INSERT INTO membres(pseudo, mail, motdepasse, prenom, nom, question, reponse) VALUES(?, ?, ?, ?, ?, ?, ?)");
                                    $insertmbr->execute(array($pseudo, $mail, $mdp, $prenom, $nom, $question, $reponse));
                                    $erreur = "Votre compte à bien été créé ! <a href=\"connexion.php\"> Me connecter </a>";

                                } else {
                                    $erreur = "Vos mots de passe ne correspondent pas !";
                                }
                            } else {
                                $erreur = "Adresse mail déjà utilisée !";
                            }
                        } else {
                            $erreur = "Veuillez rentrer une adresse mail valide ! ";
                        }
                    } else {
                        $erreur = "Pseudo déjà utilisé !";
                    }
                } else {
                    $erreur = "Votre pseudo ne doit pas dépasser les 255 caractères";
                }
            }
            else {
                $erreur = "Votre Nom ne doit pas dépasser les 255 caractères";
            }
        }
        else {
            $erreur = "Votre Prénom ne doit pas dépasser les 255 caractères";
        }
    }
    else {
        $erreur = "Tous les champs doivent être complétés !";
    }
}

?>

<?php require 'layout/header.php' ?>

<main>

<form method="POST" action="">
    <div class="card border-primary mb-3" align="center">
        <div class="card-header">Créer un compte</div>
        <div class="card-body">
            <p class="card-text">
                <label class="h5">Pseudo :</label>
                <input type="text" class="form-input form-control" placeholder="Votre Pseudo" name="pseudo" value="<?php if(isset($pseudo)) { echo $pseudo; } ?>" />
            </p>
            <p class="card-text">
                <label class="h5">Mot de passe :</label>
                <input type="password" class="form-input form-control" placeholder="Votre Mot de passe" name="mdp" />
            </p>
            <p class="card-text">
                <label class="h5">Confirmation mot de passe :</label>
                <input type="password" class="form-input form-control" placeholder="Confirmez votre mot de passe" name="mdp2" />
            </p>
        </div>
    </div>

    <div class="card border-primary mb-3" align="center">
        <div class="card-header">Détails du compte</div>
        <div class="card-body">
            <p class="card-text">
                <label class="h5">Prénom :</label>
                <input type="text" class="form-input form-control" placeholder="Votre Prénom" name="prenom" © />
            </p>
            <p class="card-text">
                <label class="h5">Nom :</label>
                <input type="text" class="form-input form-control" placeholder="Votre Nom" name="nom" value="<?php if(isset($nom)) { echo $nom; } ?>" />
            </p>
            <p class="card-text">
                <label class="h5">Email :</label>
                <input type="text" class="form-input form-control" placeholder="Votre Email" name="mail" value="<?php if(isset($mail)) { echo $mail; } ?>" />
            </p>
            <p class="card-text">
                <label class="h5">Question secrète :</label>
                <select class="form-input form-select form-control" size="" name="question">
                    <option value="" selected> --- Selectionner une question ---</option>
                    <option value="Quel est le nom de mon premier animal domestique ?">Quel est le nom de mon premier animal domestique ?</option>
                    <option value="Quel est le nom du pays que j’aimerais le plus visiter ?">Quel est le nom du pays que j’aimerais le plus visiter ?</option>
                    <option value="Quel est le nom du personnage historique que j’admire le plus ?">Quel est le nom du personnage historique que j’admire le plus ?</option>
                    <option value="Quelle est la marque du premier véhicule que j’ai conduit ?">Quelle est la  marque du premier véhicule que j’ai conduit ?</option>
                    <option value ="Quelle est votre couleur préférée ?">Quelle est votre couleur préférée ?</option>
                    <option value ="Quelle est votre équipe sportive favorite ?">Quelle est votre équipe sportive favorite ?</option>
                    <option value ="Quel était le métier de votre grand-père ?">Quel était le métier de votre grand-père ?</option>
                </select>
            </p>
            <p class="card-text">
                <label class="h5">Réponse :</label>
                <input type="text" class="form-input form-control" placeholder="Votre Réponse" name="reponse">
            </p>
        </div>
    </div>

    <div align="center">
        <form method="post" action="">
            <input type="submit" name="forminscription" class="btn btn-outline-danger" value="Je m'inscris" />
            <input name="submitBackButton" type="submit" class="btn btn-outline-dark" value="Retour" />
        </form>
    </div>

</form>


<br />

<?php
    if(isset($erreur ))
    {
        echo $erreur;
    }
?>

</main>

<?php require 'layout/footer.php' ?>


