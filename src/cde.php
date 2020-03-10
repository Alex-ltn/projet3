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
        <img src="../public/img/partenaires/CDE.png">
        </div>
        <br />
        <p>La CDE (Chambre Des Entrepreneurs) accompagne les entreprises dans leurs démarches de formation. Son président est élu pour 3 ans par ses pairs, chefs d’entreprises et présidents des CDE.</p>
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
