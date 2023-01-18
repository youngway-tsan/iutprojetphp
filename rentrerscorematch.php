<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Rentrer score - F.C. WOIPPY</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="img/FCWoippy-logo.png">
    </head>

    <?php
        
        
        session_start();
        if ($_SESSION["connected"] != True){
            header('Location: index.php');
        }
        
        require_once("header.php");
        $header = new header();

        // Initialisation des variables
        $info_execution = "";
        require_once("sql.php");
        $sql = new requeteSQL();

        $id = $_GET['id'];
        $reqMatchId = $sql->matchId($id);
        while ($row = $reqMatchId->fetch()) {
            $datetime = $row['Date_Rencontre'];
            $nomAdversaire = $row['Nom_Equipe_Adverse'];
            $lieu = $row['Lieu_Rencontre'];
        }


        // Ajouter un match
        if (isset($_POST['ajouter'])) {
            // Vérification de si tout les champs sont remplis
            try{   
                // Ajout du score d'un match
                $score = $_POST['score-match-domicile'].'-'.$_POST['score-match-visiteur'];
                $sql->modifierScoreMatch($id,$score);
                $info_execution = 'Le score a bien été enregistré !';
                header("Refresh: 3;URL=listematch.php");
            }catch(Exception $e){
                $info_execution = "Erreur : " . $e->getMessage();
            }
        } 
    ?>

    <body>
        <main class="main-creation-joueur">
            <section class="creation-tournoi-container">
                <form action="<?php echo "rentrerscorematch.php?id=" . $id ?>" method="POST">

                    <h1 class="creation-tournoi-title">Rentrer le score du match</h1>
                    <div class="creation-tournoi">
                        <div class="creation-tournoi-left">
                            <div class="creation-tournoi-input">
                                <label for="datetime-match-modif">Date et heure du match</label>
                                <input type="datetime-local" name="datetime-match-modif" id="datetime-match-modif" value="<?php echo $datetime ?>" disabled="disabled">
                            </div>
                            <div class="creation-tournoi-input">
                                <label for="nom-team-adverse-modif">Nom de l'équipe adverse</label>
                                <input type="text" name="nom-team-adverse-modif" id="nom-team-adverse-modif" value="<?php echo $nomAdversaire ?>" disabled="disabled">
                            </div>
                            <div class="creation-tournoi-input">
                                <label for="combobox-lieu-match">Lieu de Rencontre</label>
                                <select name="combobox-lieu-match-modif" id="combobox-lieu-match-modif" disabled="disabled">
                                    <?php
                                        if ($lieu == "Domicile") {
                                            echo '<option value="Domicile" selected>Domicile</option>';
                                        }else{
                                            echo '<option value="Domicile">Domicile</option>';
                                        }
                                        if ($lieu == "Extérieur") {
                                            echo '<option value="Extérieur" selected>Extérieur</option>';
                                        }else{
                                            echo '<option value="Extérieur">Extérieur</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="creation-tournoi-input">
                                <label for="score-match">Score du match</label>
                                <label for="score-match">(Domicile à gauche | Visiteur à droite)</label>
                            </div>
                                <input type="number" id="score-match-domicile" name="score-match-domicile" min="0" max="99" value=0>
                                <label for="score-match">-</label>   
                                <input type="number" id="score-match-visiteur" name="score-match-visiteur" min="0" max="99" value=0>
                        </div>
                    </div>
                    <input class="submit" type="submit" name="ajouter" value="AJOUTER">
                    <span><?php echo $info_execution?> </span>
                </form>
            </section>
        </main>
    </body>
</html>