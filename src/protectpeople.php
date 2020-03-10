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
            <img src="../public/img/partenaires/protectpeople.png">
        </div>
        <br />
        <p>Protectpeople finance la solidarité nationale.
            Nous appliquons le principe édifié par la Sécurité sociale française en 1945 : permettre à chacun de bénéficier d’une protection sociale.
        </p>
        <p>Chez Protectpeople, chacun cotise selon ses moyens et reçoit selon ses besoins.
            Proectecpeople est ouvert à tous, sans considération d’âge ou d’état de santé.
            Nous garantissons un accès aux soins et une retraite.
            Chaque année, nous collectons et répartissons 300 milliards d’euros.
            Notre mission est double :</p>
        <ul>
            <li>- sociale : nous garantissons la fiabilité des données sociales ;</li>
            <li>- économique : nous apportons une contribution aux activités économiques.</li>
        </ul>
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
