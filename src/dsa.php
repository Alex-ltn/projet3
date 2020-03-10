<?php

require_once('../config/db.php');

if (isset($_GET['id']) AND $_GET['id'] > 0)
{
    $getid = intval($_GET['id']);
    $requser = $BDD->prepare('SELECT * FROM membres WHERE id = ?');
    $requser->execute(array($getid));
    $userinfo = $requser->fetch();
}

if (isset($_POST['submitBackButton'])) {
    header("Location: acteurs.php?id=".$_SESSION['id']);
}

?>

<?php require 'layout/header.php' ?>

<main>
    <section class="jumbotron">
        <div align="center">
            <img src="../public/img/partenaires/Dsa_france.png">
        </div>
        <br />
        <p>Dsa France accélère la croissance du territoire et s’engage avec les collectivités territoriales. Nous accompagnons les entreprises dans les étapes clés de leur évolution. Notre philosophie : s’adapter à chaque entreprise. Nous les accompagnons pour voir plus grand et plus loin et proposons des solutions de financement adaptées à chaque étape de la vie des entreprises.</p>
    </section>

    <div align="center">
        <form method="post" action="">
            <button type="submit" name="submitBackButton" class="btn btn-outline-dark">Retour</button>
        </form>
        <br />
    </div>

    <section>
        <h2 align="center">Commentaires</h2>
        <div class="card mb-3 border-primary">

        </div>
    </section>
</main>

<?php require 'layout/footer.php' ?>
