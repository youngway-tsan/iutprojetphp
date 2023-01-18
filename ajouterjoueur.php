<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ajouter un joueur - F.C. WOIPPY</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="img/FCWoippy-logo.png">
    </head>

    <?php
        require_once("header.php");
        $header = new header();

        session_start();
        if ($_SESSION["connected"] != True){
            header("index.php");
        }

        // Initialisation des variables
        $info_execution = "";
        require_once("sql.php");
        $sql = new requeteSQL();

        // Ajouter un joueur
        if (isset($_POST['ajouter'])) {
            // Vérification de si tout les champs sont remplis
            if(!empty($_POST['nom-joueur']) && !empty($_POST['prenom-joueur']) && !empty($_POST['licence-joueur']) && !empty($_POST['combobox-poste-joueur']) && !empty($_POST['poids-joueur']) && !empty($_POST['taille-joueur']) && !empty($_POST['dtn-joueur'])){
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
                        // On récupère les informations du fichier upload par l'utilisateur
                        $file = $_FILES['photo-joueur'];
                        // On récupère le nom du fichier
                        $fileName = $_FILES['photo-joueur']['name'];
                        // On récupère le chemin temporaire du fichier
                        $fileTmpName = $_FILES['photo-joueur']['tmp_name'];
                        // On récupère la taille du fichier
                        $fileSize = $_FILES['photo-joueur']['size'];
                        // On récupère le code d'erreur du fichier
                        $fileError = $_FILES['photo-joueur']['error'];
                        // On récupère le type du fichier
                        $fileType = $_FILES['photo-joueur']['type'];

                        // On récupère l'extension du fichier
                        $fileExt = explode('.', $fileName);
                        // On récupère l'extension du fichier en minuscule
                        $fileActualExt = strtolower(end($fileExt));

                        // On définit les extensions autorisées
                        $allowed = array('jpg', 'jpeg', 'png');

                        if (in_array($fileActualExt, $allowed)) {
                            if ($fileError === 0) {
                                if ($fileSize < 2000000) {
                                    // On créé un nom unique pour le fichier
                                    $fileNameNew = uniqid('', true).".".$fileActualExt;
                                    // On déplace le fichier dans le dossier imgplayers
                                    $fileDestination = 'imgplayers/'.$fileNameNew;
                                    move_uploaded_file($fileTmpName, $fileDestination);
                                    // succès
                                    try{    
                                        // Ajout d'un joueur 
                                        $sql->addJoueur($_POST['licence-joueur'],$_POST['nom-joueur'],$_POST['prenom-joueur'],$_POST['dtn-joueur'],$_POST['taille-joueur'],$_POST['poids-joueur'],$_POST['combobox-poste-joueur'],$fileNameNew);
                                        $info_execution = 'Joueur enregistré !';
                                    }catch(Exception $e){
                                        $info_execution = "Erreur : " . $e->getMessage();
                                    }
                                } else {
                                    $info_execution = "Votre fichier est trop volumineux! taille max : 2Mo";
                                }
                            } else {
                                $info_execution = "Erreur de téléchargement, veuillez réessayer.";
                            }
                        } else {
                            $info_execution = "Vous ne pouvez pas télécharger ce type de fichier! Formats acceptés : jpg, jpeg, png. Taille max : 2M";
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
                <form action="ajouterjoueur.php" method="POST" enctype="multipart/form-data">

                    <h1 class="creation-tournoi-title">Ajouter un joueur</h1>
                    <div class="creation-tournoi">
                        <div class="creation-tournoi-left">
                            <div class="creation-tournoi-input">
                                <label for="nom-joueur">Nom du joueur</label>
                                <input type="text" name="nom-joueur" id="nom-joueur">
                            </div>
                            <div class="creation-tournoi-input">
                                <label for="prenom-joueur">Prénom du joueur</label>
                                <input type="text" name="prenom-joueur" id="prenom-joueur">
                            </div>
                            <div class="creation-tournoi-input">
                                <label for="licence-joueur">Licence du joueur</label>
                                <input type="text" name="licence-joueur" id="licence-joueur">
                            </div>
                            <div class="creation-tournoi-input">
                                <label for="dtn_joueur">Date de naissance</label>
                                <input type="date" name="dtn-joueur" id="dtn-joueur">
                            </div>
                        </div>

                            <div class="creation-tournoi-right">
                                <div class="creation-tournoi-input">
                                    <label for="combobox-poste-joueur">Poste</label>
                                    <select name="combobox-poste-joueur" id="combobox-poste-joueur">
                                        <option value="Gardien">Gardien</option>
                                        <option value="Défenseur">Défenseur</option>
                                        <option value="Milieu">Milieu</option>
                                        <option value="Attaquant">Attaquant</option>
                                    </select>
                                </div>
                                <div class="creation-tournoi-input">
                                    <label for="taille-joueur">Taille du joueur (en cm)</label>
                                    <input type="number" id="taille-joueur" name="taille-joueur" min="140" max="250">
                                </div>
                                <div class="creation-tournoi-input">
                                    <label for="poids-joueur">Poids du joueur (en kg)</label>
                                    <input type="number" id="poids-joueur" name="poids-joueur" min="40" max="175">
                                </div>
                                <div class="creation-tournoi-input">
                                    <label for="photo-joueur">Photo du joueur</label>
                                    <input type="file" name="photo-joueur" id="photo-joueur">
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
