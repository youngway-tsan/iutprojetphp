<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ajouter un match - F.C. WOIPPY</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="img/FCWoippy-logo.png">
    </head>

    <?php
        require_once("header.php");
        $header = new header();

        session_start();
        if ($_SESSION["connected"] != True){
            header('Location: index.php');
        }
        
        // Initialisation des variables
        $info_execution = "";
        require_once("sql.php");
        $sql = new requeteSQL();

        // Ajouter un match
        if (isset($_POST['ajouter'])) {
            // Vérification de si tout les champs sont remplis
            if(!empty($_POST['datetime-match']) && !empty($_POST['nom-team-adverse']) && !empty($_POST['combobox-lieu-match'])){
                // Vérification de si la date du match est valide
                if (strtotime($_POST['datetime-match']) > strtotime(date("Y-m-d H:i:s") . ' + 1 week')) {      
                    try{   
                        // Ajout d'un match
                        $sql->addMatch($_POST['datetime-match'],$_POST['nom-team-adverse'],$_POST['combobox-lieu-match']);
                        $info_execution = 'Match enregistré !';
                    }catch(Exception $e){
                        $info_execution = "Erreur : " . $e->getMessage();
                    }
                } else {
                    $info_execution = "L'horaire du match est non valide (1 semaines de délais minimum)";
                }
            } else {
                $info_execution = "Veuillez remplir tous les champs";
            }
        } 
    ?>

    <body>
        <main class="main-creation-joueur">
            <section class="creation-tournoi-container">
                <form action="ajoutermatch.php" method="POST">

                    <h1 class="creation-tournoi-title">Ajouter un match</h1>
                    <div class="creation-tournoi">
                        <div class="creation-tournoi-left">
                            <div class="creation-tournoi-input">
                                <label for="datetime-match">Date et heure du match</label>
                                <input type="datetime-local" name="datetime-match" id="datetime-match">
                            </div>
                            <div class="creation-tournoi-input">
                                <label for="nom-team-adverse">Nom de l'équipe adverse</label>
                                <input type="text" name="nom-team-adverse" id="nom-team-adverse">
                            </div>
                            <div class="creation-tournoi-input">
                                    <label for="combobox-lieu-match">Lieu de Rencontre</label>
                                    <select name="combobox-lieu-match" id="combobox-lieu-match">
                                        <option value="Domicile">Domicile</option>
                                        <option value="Extérieur">Extérieur</option>
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