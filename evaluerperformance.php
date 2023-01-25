<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Evaluer Performance - F.C. WOIPPY</title>
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

        $id_rencontre = $_GET['id'];
        $titulaire = $sql->getTitulaireRencontre($id_rencontre);
        $remplacant = $sql->getRemplacantRencontre($id_rencontre);

        $nom_equipe = $sql->getNomEquipeAdverse($id_rencontre) -> fetch()[0];

        if ($_POST['submitNote']){
            $sql->setNoteJoueur($_POST['licenceJoueur'], $_GET['id'], $_POST['rating']);
        }
    ?>

    <main class="main-listes">
        <section class="main-listes-container">

            <h1>Evaluer les joueurs (F.C WOIPPY - <?php echo $nom_equipe;?>) </h1>
            <hr>
            <form action="" method="post">
            
                <div class="container">
                    <div class="containerGauche">
                        <div class="listeElement">
                            <h2>Titulaires</h2>
                            <?php 
                                while ($donnees = $titulaire -> fetch()){
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
                            <h2>Remplaçants</h2>
                            <?php
                                while ($donnees = $remplacant->fetch()) {
                                    $nomJoueur = $sql->joueurId($donnees[0])->fetch()[1];
                                    $prenomJoueur = $sql->joueurId($donnees[0])->fetch()[2];
                                    echo '  
                                            <button type="submit" class="element" name="submitJoueur" value=' . $donnees[0] . '>
                                                <div class="nomJoueur">
                                                    <span>' . $nomJoueur . ' ' . $prenomJoueur . '</span>
                                                </div>
                                            </button>
                                        ';
                                }
                            ?>
                        </div>
                    </div>

                    <div class="containerDroite">
                        <?php
                            if (isset($_POST['submitJoueur'])){
                                $licenceJoueur = $sql->joueurId($_POST['submitJoueur'])->fetch()['Licence'];
                                $nomJoueur = $sql->joueurId($_POST['submitJoueur'])->fetch()['Nom'];
                                $prenomJoueur = $sql->joueurId($_POST['submitJoueur'])->fetch()['Prenom'];
                                $posteJoueur = $sql->joueurId($_POST['submitJoueur'])->fetch()['Poste'];
                                $imageJoueur = $sql->joueurId($_POST['submitJoueur'])->fetch()['Image'];
                                $notationJoueur = $sql -> getNotationJoueur($_GET['id'],$licenceJoueur) -> fetch()[0];
                            echo '
                                    <div class="container-info-joueur">
                                        <div class="infoEtImage">
                                            <div class="info">
                                                <h2>' . $nomJoueur . '  ' . $prenomJoueur . '</h2>
                                                <h3>(' . $posteJoueur . ')</h3>
                                                ';
                                                if ($notationJoueur == null){
                                                echo '
                                                <div class="notation">
                                                    <div class="note">
                                                        <input type="radio" id="star5" name="rating" value="5" />
                                                        <label for="star5">5</label>
                                                    </div>
                                                    
                                                    <div class="note">
                                                        <input type="radio" id="star4" name="rating" value="4" />
                                                        <label for="star4">4</label>
                                                    </div>

                                                    <div class="note">
                                                        <input type="radio" id="star3" name="rating" value="3" />
                                                        <label for="star3">3</label>
                                                    </div>

                                                    <div class="note">
                                                        <input type="radio" id="star2" name="rating" value="2" />
                                                        <label for="star2">2</label>
                                                    </div>

                                                    <div class="note">
                                                        <input type="radio" id="star1" name="rating" value="1" />
                                                        <label for="star1">1</label>
                                                    </div>

                                                </div>
                                                <button type="submit" class="submit" name="submitNote" value='.$_POST['submitJoueur'].'>Valider</button>
                                                ';
                                                } else {
                                                    echo '
                                                        <h3 class="noteMatch">Note du match : '.$notationJoueur.' / 5 </h3>
                                                    ';
                                                }
                                                echo '
                                                <input type="hidden" name="licenceJoueur" value='.$licenceJoueur.'>
                                            </div>

                                            <div class="image">
                                                <img id="preview" src='.$imageJoueur.' alt="Photo " width="200" height="200" >
                                            </div>
                                        <div>
                                    </div>
                                ';
                            }
                        ?>
                    </div>
                </div>

            </form>
        </section>
    </main>

</body>
</html>