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
            <img src="../public/img/partenaires/formation_co.png">
        </div>
        <br />
        <p>Formation&co est une association française présente sur tout le territoire.
            Nous proposons à des personnes issues de tout milieu de devenir entrepreneur grâce à un crédit et un accompagnement professionnel et personnalisé.
            Notre proposition : </p>
        <ul>
            <li>- un financement jusqu’à 30 000€ ;</li>
            <li>- un suivi personnalisé et gratuit ;</li>
            <li>- une lutte acharnée contre les freins sociétaux et les stéréotypes.</li>
        </ul>
        <br />
        <p>Le financement est possible, peu importe le métier : coiffeur, banquier, éleveur de chèvres… . Nous collaborons avec des personnes talentueuses et motivées.
            Vous n’avez pas de diplômes ? Ce n’est pas un problème pour nous ! Nos financements s’adressent à tous.</p>
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
