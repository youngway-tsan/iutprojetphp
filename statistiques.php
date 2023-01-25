<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/FCWoippy-logo.png">
    <title>STATISTIQUES - F.C. WOIPPY</title>
</head>
<body>
    <?php
        session_start();
        if ($_SESSION["connected"] != True){
            header('Location: index.php');
        }
        
        require_once("header.php");
        $header = new header();

        require_once("sql.php");
        $sql = new requeteSQL();

        $reqGardiens = $sql->getJoueursByPoste("Gardien");
        $reqDefenseurs = $sql->getJoueursByPoste("Défenseur");
        $reqMilieux = $sql->getJoueursByPoste("Milieu");
        $reqAttaquants = $sql->getJoueursByPoste("Attaquant");
        
    ?>

    <main class="main-listes">
        <section class="main-listes-container">

            <h1>Statistiques du F.C. WOIPPY </h1>
            <hr>

            <form action="" method="post">
                <div class="container">
                    
                    <div class="containerGauche">
                        <div class="listeElement">
                            <h2>Equipe</h2>
                            <button type="submit" class="element" name="submitEquipe" value='Equipe'>
                                <span>Statistiques du club</span>
                            </button>

                            <h2>Gardiens</h2>
                            <?php
                                while ($donnees = $reqGardiens -> fetch()){
                                    $nomJoueur = $sql -> joueurId($donnees[0]) -> fetch()[1];
                                    $prenomJoueur = $sql -> joueurId($donnees[0]) -> fetch()[2];
                                    echo '
                                        <button type="submit" class="element" name="submitJoueur" value='.$donnees[0].'>
                                            <div class="nomJoueur">
                                                <span>'.$nomJoueur.' '.$prenomJoueur.'</span>
                                            </div>
                                        </button>
                                    ';
                                }
                            ?>

                            <h2>Défenseurs</h2>
                            <?php
                                while ($donnees = $reqDefenseurs -> fetch()){
                                    $nomJoueur = $sql -> joueurId($donnees[0]) -> fetch()[1];
                                    $prenomJoueur = $sql -> joueurId($donnees[0]) -> fetch()[2];
                                    echo '
                                        <button type="submit" class="element" name="submitJoueur" value='.$donnees[0].'>
                                            <div class="nomJoueur">
                                                <span>'.$nomJoueur.' '.$prenomJoueur.'</span>
                                            </div>
                                        </button>
                                    ';
                                }
                            ?>

                            <h2>Milieux</h2>
                            <?php
                                while ($donnees = $reqMilieux -> fetch()){
                                    $nomJoueur = $sql -> joueurId($donnees[0]) -> fetch()[1];
                                    $prenomJoueur = $sql -> joueurId($donnees[0]) -> fetch()[2];
                                    echo '
                                        <button type="submit" class="element" name="submitJoueur" value='.$donnees[0].'>
                                            <div class="nomJoueur">
                                                <span>'.$nomJoueur.' '.$prenomJoueur.'</span>
                                            </div>
                                        </button>
                                    ';
                                }
                            ?>

                            <h2>Attaquants</h2>
                            <?php
                                while ($donnees = $reqAttaquants -> fetch()){
                                    $nomJoueur = $sql -> joueurId($donnees[0]) -> fetch()[1];
                                    $prenomJoueur = $sql -> joueurId($donnees[0]) -> fetch()[2];
                                    echo '
                                        <button type="submit" class="element" name="submitJoueur" value='.$donnees[0].'>
                                            <div class="nomJoueur">
                                                <span>'.$nomJoueur.' '.$prenomJoueur.'</span>
                                            </div>
                                        </button>
                                    ';
                                }
                            ?>


                        </div>
                    </div>
                    
                        <?php
                            if (isset($_POST['submitJoueur'])) {
                                $licenceJoueur = $sql->joueurId($_POST['submitJoueur'])->fetch()['Licence'];
                                $nomJoueur = $sql->joueurId($_POST['submitJoueur'])->fetch()['Nom'];
                                $prenomJoueur = $sql->joueurId($_POST['submitJoueur'])->fetch()['Prenom'];
                                $posteJoueur = $sql->joueurId($_POST['submitJoueur'])->fetch()['Poste'];
                                $statutJoueur = $sql->joueurId($_POST['submitJoueur'])->fetch()['Statut'];
                                $imageJoueur = $sql->joueurId($_POST['submitJoueur'])->fetch()['Image'];
                                
                                //Requête Equipe
                                $nbRencontre = $sql->getNbRencontre() -> fetch()[0];
                                $nbRencontreGagne = $sql->getNbRencontreGagne();
                                $nbRencontreEgalite = $sql->getNbRencontreGagne();
                                $nbRencontrePerdu = $sql->getNbRencontreGagne();

                                //Requête Joueur
                                $nbSelectionTitulaire = $sql->getNbselectionTitulaire($licenceJoueur) -> fetch()[0];
                                $nbSelectionRemplacant = $sql->getNbselectionRemplacant($licenceJoueur) -> fetch()[0];
                                $reqNoteMoyenne = $sql->getNoteMoyenneJoueur($licenceJoueur);
                                if ($reqNoteMoyenne == false){
                                    $noteMoyenne = "-";
                                } else {
                                    $noteMoyenne = $reqNoteMoyenne;
                                }
                                $nbRencontreParticiper = $sql -> getNbRencontreParticiper($licenceJoueur) -> fetch()[0];
                                $nbRencontreGagneJoueur = $sql->getNbRencontreGagnéesJoueur($licenceJoueur);
                                if ($nbRencontreParticiper == 0) {
                                    $pourcentage = "-";
                                } else {
                                    $pourcentage = round((($nbRencontreGagneJoueur / $nbRencontreParticiper) * 100), 2);
                                }

                                echo '
                                <div class="containerDroite">
                                    <div class="container-info-joueur">
                                        <div class="infoEtImage">
                                            <div class="info">
                                                <h2>' . $nomJoueur . '  ' . $prenomJoueur . '</h2>
                                                <h3> '.$statutJoueur. '  /  '. $posteJoueur . '</h3>
                                                <div class="stats">
                                                    <span>Nombre de sélections en tant que titulaire : '.$nbSelectionTitulaire.' </span>
                                                    <span>Nombre de sélections en tant que remplaçant : '.$nbSelectionRemplacant.' </span>
                                                    <span>Note moyenne : '.$noteMoyenne.' \ 5 </span>
                                                    <span>Matchs gagnés lorsque sélectionné : '.$pourcentage.' % </span>
                                                </div>
                                            </div>
                                            <div class="image">
                                                <img id="preview" src='.$imageJoueur.' alt="Photo " width="200" height="200" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ';
                            }

                            if (isset($_POST['submitEquipe'])){
                                //Requête Equipe
                                $nbRencontre = $sql->getNbRencontre() -> fetch()[0];
                              

                                if ($nbRencontre != 0){
                                    $nbRencontreGagne = $sql->getNbRencontreGagne();
                                    $nbRencontreEgalite = $sql->getNbRencontreEgalite();
                                    $nbRencontrePerdu = $sql->getNbRencontrePerdu();
                                    $pourcentageMatchGagne = round((($nbRencontreGagne / $nbRencontre) * 100),2);
                                    $pourcentageMatchPerdu = round((($nbRencontrePerdu / $nbRencontre) * 100),2);
                                    $poucentageMatchNul = round((($nbRencontreEgalite / $nbRencontre) * 100),2);
                                    echo '
                                    <div class="containerDroite">
                                        <div class="container-info-joueur">
                                            <div class="infoEtImage">
                                                <div class="info">
                                                    <h2>FC WOIPPY</h2>
                                                    <div class="stats">
                                                        <span>Nombre total de match: ' . $nbRencontre . ' </span>
                                                        <span>Pourcentage de matchs gagnés : ' . $pourcentageMatchGagne . ' % </span>
                                                        <span>Pourcentage de matchs perdus : ' . $pourcentageMatchPerdu . ' %</span>
                                                        <span>Pourcentage de matchs nuls : ' . $poucentageMatchNul . ' %</span>
                                                    </div>
                                                </div>
                                                <div class="image">
                                                    <img id="preview" src="img/FCWoippy-logo.png" alt="Photo " width="200" height="200" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    ';
                                } else {
                                    echo '
                                    <div class="containerDroite">
                                        <div class="container-info-joueur">
                                            <div class="infoEtImage">
                                                <div class="info">
                                                    <h2>FC WOIPPY</h2>
                                                    <div class="stats">
                                                        <span>Aucun match joué </span>
                                                        <span>Pourcentage de matchs gagnés : - % </span>
                                                        <span>Pourcentage de matchs perdus : - %</span>
                                                        <span>Pourcentage de matchs nuls :  -  %</span>
                                                    </div>
                                                </div>
                                                <div class="image">
                                                    <img id="preview" src="img/FCWoippy-logo.png" alt="Photo " width="200" height="200" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    ';
                                }
                                }
                        ?>
                    </div>
                </div>
            </form>
        </section>
    </main>
</body>
</html>