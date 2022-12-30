<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modifier un joueur - F.C. WOIPPY</title>
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

        $licence = $_GET['licence'];
        $reqJoueurId = $sql->joueurId($licence);
        while ($row = $reqJoueurId->fetch()) {
            $nom = $row['Nom'];
            $prenom = $row['Prenom'];
            $dtn = $row['Date_naissance'];
            $taille = $row['Taille'];
            $poids = $row['Poids'];
            $poste = $row['Poste'];
            $photo = $row['Image'];
        }

        // Modifier un joueur
        if (isset($_POST['modifier'])) {
            // Vérification de si tout les champs sont remplis
            if(!empty($_POST['nom-joueur']) && !empty($_POST['prenom-joueur']) && !empty($_POST['licence-joueur']) && !empty($_POST['combobox-poste-joueur']) && !empty($_POST['poids-joueur']) && !empty($_POST['taille-joueur']) && !empty($_POST['photo-joueur']) && !empty($_POST['dtn-joueur'])){
                // Vérification de si le joueur à plus de 16ans
                if (strtotime($_POST['dtn-joueur']) <= strtotime(date("Y-m-d") . ' - 16 years')) {   
                    //Vérification de si un joueur n'a pas déjà le même numéro licence
                    $joueurs = $sql->getJoueurs();
                    $sameLicence = False;
                    while($joueur = $joueurs->fetch()) {
                        if (strtoupper($joueur['Licence']) == strtoupper($_POST['licence-joueur'])) {
                            $sameLicence = True;
                        }
                    }
                    if(!$sameLicence) {
                        try{   
                            // Ajout d'un joueur 
                            $sql->addJoueur($_POST['licence-joueur'],$_POST['nom-joueur'],$_POST['prenom-joueur'],$_POST['dtn-joueur'],$_POST['taille-joueur'],$_POST['poids-joueur'],$_POST['combobox-poste-joueur'],$_POST['photo-joueur']);
                            $info_execution = 'Joueur enregistré !';
                        }catch(Exception $e){
                            $info_execution = "Erreur : " . $e->getMessage();
                        }
                    }else{
                        $info_execution = "Un joueur avec le même numéro de licence existe déjà !";
                    }
                } else {
                    $info_execution = "Le Joueur doit avoir plus de 16 ans pour s'inscrire à une équipe de foot sénior";
                }
            } else {
                $info_execution = "Veuillez remplir tous les champs";
            }
        } 
    ?>

    <body>
        <main class="main-creation-joueur">
            <section class="creation-tournoi-container">
                <form action="<?php echo "modificationjoueur.php?id=" . $licence ?>" method="POST">

                    <h1 class="creation-tournoi-title">Modifier un joueur</h1>
                    <div class="creation-tournoi">
                        <div class="creation-tournoi-left">
                            <div class="creation-tournoi-input">
                                <label for="nom-joueur">Nom du joueur</label>
                                <input type="text" name="nom-joueur" id="nom-joueur" value="<?php echo $nom ?>">
                            </div>
                            <div class="creation-tournoi-input">
                                <label for="prenom-joueur">Prénom du joueur</label>
                                <input type="text" name="prenom-joueur" id="prenom-joueur" value="<?php echo $prenom ?>">
                            </div>
                            <div class="creation-tournoi-input">
                                <label for="licence-joueur">Licence du joueur</label>
                                <input type="text" name="licence-joueur" id="licence-joueur" value="<?php echo $licence ?>">
                            </div>
                            <div class="creation-tournoi-input">
                                <label for="dtn_joueur">Date de naissance</label>
                                <input type="date" name="dtn-joueur" id="dtn-joueur" value="<?php echo $dtn ?>">
                            </div>
                        </div>

                            <div class="creation-tournoi-right">
                                <div class="creation-tournoi-input">
                                    <label for="combobox-poste-joueur">Poste</label>
                                    <select name="combobox-poste-joueur" id="combobox-poste-joueur">
                                    <?php
                                        if ($poste == "Gardien") {
                                            echo '<option value="Gardien" selected>Gardien</option>';
                                        }else{
                                            echo '<option value="Gardien">Gardien</option>';
                                        }
                                        if ($poste == "Défenseur") {
                                            echo '<option value="Défenseur" selected>Défenseur</option>';
                                        }else{
                                            echo '<option value="Défenseur">Défenseur</option>';
                                        }
                                        if ($poste == "Milieu") {
                                            echo ' <option value="Milieu" selected>Milieu</option>';
                                        }else{
                                            echo ' <option value="Milieu">Milieu</option>';
                                        }
                                        if ($poste == "Attaquant") {
                                            echo '<option value="Attaquant" selected>Attaquant</option>';
                                        }else{
                                            echo '<option value="Attaquant">Attaquant</option>';
                                        }
                                    ?>
                                    </select>
                                </div>
                                <div class="creation-tournoi-input">
                                    <label for="taille-joueur">Taille du joueur (en cm)</label>
                                    <input type="number" id="taille-joueur" name="taille-joueur" min="1" max="250" value="<?php echo $taille ?>">
                                </div>
                                <div class="creation-tournoi-input">
                                    <label for="poids-joueur">Poids du joueur (en kg)</label>
                                    <input type="number" id="poids-joueur" name="poids-joueur" min="1" max="150" value="<?php echo $poids ?>">
                                </div>
                                <div class="creation-tournoi-input">
                                    <label for="photo-joueur">Photo du joueur</label>
                                    <input type="text" name="photo-joueur" id="photo-joueur" value="<?php echo $photo ?>">
                                </div>
                            </div>
                    </div>
                    <input class="submit" type="submit" name="modifier" value="MODIFIER">
                    <span><?php echo $info_execution?> </span>
                </form>
            </section>
        </main>
    </body>


</html>
