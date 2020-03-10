<?php

require_once('../config/db.php');

if(isset($_SESSION['id'])) {

    $requser = $BDD->prepare("SELECT * FROM membres WHERE id = ?");
    $requser->execute(array($_SESSION['id']));
    $userinfo = $requser->fetch();

    if (isset($_POST['submitBackButton'])) {
        header('Location: profil.php?id='.$_SESSION['id']);
    }

    if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $userinfo['pseudo']) {
        $newpseudo = htmlspecialchars($_POST['newpseudo']);
        $insertpseudo = $BDD->prepare("UPDATE membres SET pseudo = ? WHERE id = ?");
        $insertpseudo->execute(array($newpseudo, $_SESSION['id']));
        header('Location: profil.php?id='.$_SESSION['id']);
    }
    if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $userinfo['mail']) {
        $newmail = htmlspecialchars($_POST['newmail']);
        $insertmail = $BDD->prepare("UPDATE membres SET mail = ? WHERE id = ?");
        $insertmail->execute(array($newmail, $_SESSION['id']));
        header('Location: profil.php?id='.$_SESSION['id']);
    }
    if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {
        $mdp1 = sha1($_POST['newmdp1']);
        $mdp2 = sha1($_POST['newmdp2']);
        if($mdp1 == $mdp2) {
            $insertmdp = $BDD->prepare("UPDATE membres SET motdepasse = ? WHERE id = ?");
            $insertmdp->execute(array($mdp1, $_SESSION['id']));
            header('Location: profil.php?id='.$_SESSION['id']);
        } else {
            $msg = "Vos deux mdp ne correspondent pas !";
        }
    }
    ?>

<?php require 'layout/header.php' ?>

<main>
    <form method="POST" action="">
        <div class="card border-primary mb-3">
            <div class="card-header">Édition de votre profil</div>
            <div class="card-body">
                <p class="card-title">Ici, vous pouvez changer vos informations, Pseudo, Email ou votre Mot de passe !</p>
                <p class="card-text">
                    <label class="h5">Pseudo :</label>
                    <input class="form-input form-control" type="text" name="newpseudo" placeholder="Pseudo" value="<?php echo $userinfo['pseudo']?>">
                </p>
                <p class="card-text">
                    <label class="h5">Email :</label>
                    <input class="form-input form-control" type="text" name="newmail" placeholder="Email" value="<?php echo $userinfo['mail']?>">
                </p>
                <p class="card-text">
                    <label class="h5">Mot de passe :</label>
                    <input class="form-input form-control" type="password" name="newmdp1" placeholder="Mot de passe">
                </p>
                <p class="card-text">
                    <label class="h5">Confirmation Mot de passe :</label>
                    <input class="form-input form-control" type="password" name="newmdp2" placeholder="Confirmation Mot de passe">
                </p>
            </div>
        </div>
            <div align="center">
                <form method="post" action="">
                    <input type="submit" class="btn btn-outline-danger" value="Mettre à jour">
                    <input type="submit" name="submitBackButton" class="btn btn-outline-dark" value="Retour">
                    <br /><br />
                </form>
            </div>
            <?php if(isset($msg)) { echo $msg; } ?>
    </form>

            <?php if(isset($msg)) { echo $msg; } ?>

<?php
}
else {
    header("Location: connexion.php");
}
?>

</main>

<?php require 'layout/footer.php' ?>
