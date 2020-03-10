<?php

if (isset($_GET['id']) AND $_GET['id'] > 0)
{
    $getid = intval($_GET['id']);
    $requser = $BDD->prepare('SELECT * FROM membres WHERE id = ?');
    $requser->execute(array($getid));
    $userinfo = $requser->fetch();
}

if (isset($_POST['submitProfil'])) {
    header("Location: profil.php?id=".$_SESSION['id']);
}

if (isset($_POST['submitDeco'])) {
    header('Location: deconnexion.php');
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../public/css/bootstrap.css" />
    <link rel="stylesheet" href="../public/css/style.css" />
    <title>GBAF</title>
</head>

<body>

<header>
    <?php
    if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
        ?>

    <div align="center">
        <img src="../public/img/partenaires/logo.png" alt="logo1" />
        <ul>
            <li><h5><?php echo $userinfo['prenom']; ?><?php echo " "; ?><?php echo $userinfo['nom']; ?>  </h5></li>
            <li>
                <form method="post" action="">
                    <button type="submit" class="btn btn-link" name="submitProfil">Paramètres du compte</button>
                </form>
            </li>
            <li>
                <form method="post" action="">
                    <button type="submit" class="btn btn-link" name="submitDeco">Se déconnecter</button>
                </form>
            </li>
        </ul>
    </div>

    <?php
    }
    else { ?>

        <div align="center">
            <img src="../public/img/partenaires/logo.png" alt="logo1" />
            <br /><br />
    <?php }
    ?>

</header>