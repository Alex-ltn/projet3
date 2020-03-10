<?php

require_once('../config/db.php');

if (isset($_POST['submitStop'])) {
    header('Location: deconnexion.php');
}

if(isset($_SESSION['id'])) {

    if (isset($_GET['id']) AND $_GET['id'] > 0)     // Récupération de la question secrète
    {
        $getid = intval($_GET['id']);
        $reqquestion = $BDD->prepare('SELECT * FROM membres WHERE id = ?');
        $reqquestion->execute(array($getid));
        $userinfo = $reqquestion->fetch();
    }

    if (isset($_POST['formquestion'])) {
        $reponsemdp = htmlspecialchars($_POST['reponsemdp']);

        if (!empty($reponsemdp)) {
            $requser = $BDD->prepare("SELECT * FROM membres WHERE reponse = ?");
            $requser->execute(array($reponsemdp));
            $userexist = $requser->rowCount();


            if ($userexist == 1) {
                $userinfo = $requser->fetch();
                $_SESSION['id'] = $userinfo['id'];
                $_SESSION['pseudo'] = $userinfo['pseudo'];
                header("Location: mdp_oublie.php?id=" . $_SESSION['id']);
            } else {
                $erreur = "Votre réponse est incorrecte !";
            }
        } else {
            $erreur = "Veuillez mettre une réponse !";
        }
    }

?>

<?php require 'layout/header.php' ?>

<main>
    <form method="POST" action="">
        <div class="card border-primary mb-3">
            <div class="card-header">Répondre à la question de sécurité</div>
            <div class="card-body">
                <p class="card-title">Pour changer votre mot de passe, veuillez d'abord répondre à la question de sécurité.
                    <br /><br />
                    <?php echo $userinfo['question'] ?>
                </p>
                <p class="card-text">
                    <label class="h5">Réponse :</label>
                    <input class="form-input form-control" type="text" name="reponsemdp" placeholder=" Votre Réponse">
                </p>
            </div>
            <br />
            <div align="center">
                <form method="post" action="">
                    <input type="submit" class="btn btn-outline-danger" name="formquestion" value="Suivant" />
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


<?php
}
else {
    header("Location: connexion.php");
}
?>

</main>

<?php require 'layout/footer.php' ?>
