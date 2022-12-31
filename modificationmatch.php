<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modifier un match - F.C. WOIPPY</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="img/FCWoippy-logo.png">
    </head>

    <?php
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
            if(!empty($_POST['datetime-match']) && !empty($_POST['nom-team-adverse']) && !empty($_POST['combobox-lieu-match'])){
                // Vérification de si la date du match est valide
                if (strtotime($_POST['datetime-match']) > strtotime(date("Y-m-d"))) {   
                    try{   
                        // Modification d'un match
                        $sql->modifierMatch($id,$_POST['datetime-match'],$_POST['nom-team-adverse'],$_POST['combobox-lieu-match']);
                        $info_execution = 'Modification enregistrée !';
                        header("Refresh: 3;URL=listematch.php");
                    }catch(Exception $e){
                        $info_execution = "Erreur : " . $e->getMessage();
                    }
                } else {
                    $info_execution = "L'horaire du match est non valide";
                }
            } else {
                $info_execution = "Veuillez remplir tous les champs";
            }
        } 
    ?>

    <body>
        <main class="main-creation-joueur">
            <section class="creation-tournoi-container">
                <form action="<?php echo "modificationmatch.php?id=" . $id ?>" method="POST">

                    <h1 class="creation-tournoi-title">Modifier un match</h1>
                    <div class="creation-tournoi">
                        <div class="creation-tournoi-left">
                            <div class="creation-tournoi-input">
                                <label for="datetime-match">Date et heure du match</label>
                                <input type="datetime-local" name="datetime-match" id="datetime-match" value="<?php echo $datetime ?>">
                            </div>
                            <div class="creation-tournoi-input">
                                <label for="nom-team-adverse">Nom de l'équipe adverse</label>
                                <input type="text" name="nom-team-adverse" id="nom-team-adverse" value="<?php echo $nomAdversaire ?>">
                            </div>
                            <div class="creation-tournoi-input">
                                <label for="combobox-lieu-match">Lieu de Rencontre</label>
                                <select name="combobox-lieu-match" id="combobox-lieu-match">
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
                        </div>
                    </div>
                    <input class="submit" type="submit" name="ajouter" value="AJOUTER">
                    <span><?php echo $info_execution?> </span>
                </form>
            </section>
        </main>
    </body>
</html>