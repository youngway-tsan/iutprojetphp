<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Feuille de match - F.C. WOIPPY</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="img/FCWoippy-logo.png">
    </head>

    <?php
        require_once("header.php");
        $header = new header();

        require_once("sql.php");
        $sql = new requeteSQL();

        //Requête pour remplir les selects
        $reqGardien = $sql->getJoueurs();
        $reqDefenseurs = $sql->getJoueurs();
        $reqDD = $sql->getJoueurs();
        $reqDG = $sql->getJoueurs();
        $reqDCD = $sql->getJoueurs();
        $reqDCG = $sql->getJoueurs();
        $reqMilieux = $sql->getJoueurs();
        $reqMDCD = $sql->getJoueurs();
        $reqAD = $sql->getJoueurs();
        $reqMDCG = $sql->getJoueurs();
        $reqAttaquants = $sql->getJoueurs();
        $reqBU = $sql->getJoueurs();
        $reqMOC = $sql->getJoueurs();
        $reqAG = $sql->getJoueurs();
        $reqPhotosJoueurs = $sql->getJoueurs();

        //Vérifie si tous les selects ont étaient choisis
        $selectsFull = false;

        //Initialisation de variables
        $info_execution = "";

        /** AIDE POUR CETTE PAGE :
         * DG -> DEFENSEUR GAUCHE
         * DD -> DEFENSEUR DROIT
         * DCD DEFENSEUR CENTRAL DROIT
         * DCG -> DEFENSEUR CENTRAL GAUCHE
         * MDCD -> MILIEU DEFENSIF CENTRAL DROIT
         * MDCG -> MILIEU DEFENSIF CENTRAL DROIT
         * MOC -> MILIEU OFFENSIF CENTRAL
         * AG -> ATTAQUANT GAUCHE
         * AD -> ATTAQUANT DROIT
         * BU -> BUTEUR
         * REMP -> REMPLACANT
         */


        if (empty($_POST['gardien'])) {
            $gardien = "Joueur 1";
            $gardienPhoto = "https://www.demivolee.com/wp-content/plugins/OutilCompoWordpress-2.7.0/assets/maillot/neutre.png";
        } else {
            $gardien = $_POST['gardien'];
            while ($data = $reqPhotosJoueurs->fetch()) {
                if ($data['Nom'] == $gardien) { 
                    $gardienPhoto = $data['Image'];
                }               
            }
        }

        if (empty($_POST['dg'])) {
            $dg = "Joueur 3";
        } else {
            $dg = $_POST['dg'];
        }

        if (empty($_POST['dcg'])) {
            $dcg = "Joueur 5";
        } else {
            $dcg = $_POST['dcg'];
        }

        if (empty($_POST['dcd'])) {
            $dcd = "Joueur 4";
        } else {
            $dcd = $_POST['dcd'];
        }

        if (empty($_POST['dd'])) {
            $dd = "Joueur 2";
        } else {
            $dd = $_POST['dd'];
        }

        if (empty($_POST['mdcd'])) {
            $mdcd = "Joueur 6";
        } else {
            $mdcd = $_POST['mdcd'];
        }

        if (empty($_POST['mdcg'])) {
            $mdcg = "Joueur 8";
        } else {
            $mdcg = $_POST['mdcg'];
        }

        if (empty($_POST['moc'])) {
            $moc= "Joueur 10";
        } else {
            $moc = $_POST['moc'];
        }

        if (empty($_POST['ag'])) {
            $ag= "Joueur 11";
        } else {
            $ag = $_POST['ag'];
        }

        if (empty($_POST['ad'])) {
            $ad= "Joueur 7";
        } else {
            $ad = $_POST['ad'];
        }

        if (empty($_POST['bu'])) {
            $bu= "Joueur 9";
        } else {
            $bu = $_POST['bu'];
        }

        $id = $_GET['id'];
        $reqMatchId = $sql->matchId($id);
        while ($row = $reqMatchId->fetch()) {
            $datetime = $row['Date_Rencontre'];
            $nomAdversaire = $row['Nom_Equipe_Adverse'];
            $lieu = $row['Lieu_Rencontre'];
        }

        if (isset($_POST['Supprimer'])) {
            $gardien = "Joueur 1";
            $dg = "Joueur 3";
            $dcg = "Joueur 5";
            $dcd = "Joueur 4";
            $dd = "Joueur 2";
            $mdcd = "Joueur 6";
            $mdcg = "Joueur 8";
            $moc= "Joueur 10";
            $ag= "Joueur 11";
            $ad= "Joueur 7";
            $bu= "Joueur 9";
        }

        if (isset($_POST['Valider'])) {
            if(($_POST['gardien'] != 'Joueur 1') && ($_POST['dd'] != 'Joueur 2') && ($_POST['dg'] != 'Joueur 3') && ($_POST['dcd'] != 'Joueur 4') && ($_POST['dcg'] != 'Joueur 5') && ($_POST['mdcd'] != 'Joueur 6') && ($_POST['ad'] != 'Joueur 7') && ($_POST['mdcg'] != 'Joueur 8') && ($_POST['bu'] != 'Joueur 9') && ($_POST['moc'] != 'Joueur 10') && ($_POST['ag'] != 'Joueur 11')) {
                $selectsFull = true;
                $info_execution = "Joueurs titulaires validés !";
            } else {
                $info_execution = "Veuillez sélectionner tous les joueurs titulaires du match !";
                $gardien = "Joueur 1";
                $dg = "Joueur 3";
                $dcg = "Joueur 5";
                $dcd = "Joueur 4";
                $dd = "Joueur 2";
                $mdcd = "Joueur 6";
                $mdcg = "Joueur 8";
                $moc= "Joueur 10";
                $ag= "Joueur 11";
                $ad= "Joueur 7";
                $bu= "Joueur 9";
            }
        }

        

    ?>

    <body>
        <main class="main-listes">
            <section class="main-listes-container">
                <div class="container-feuille">
                    <div class="container-gauche">
                        <h1>Feuille de match : <?php echo $nomAdversaire ?> [<?php echo $lieu ?>]</h1>
                        <hr>
                        
                            <div class="terrain_foot">
                                <!-- Composition -->
                                <svg  width="100%" height="100%" id="svg" viewBox="0 0 1150 820" xmlns="http://www.w3.org/2000/svg">
                                    <image  height="1220" id="field" width="1150" x="0" y="0" xlink:href="https://www.demivolee.com/wp-content/plugins/OutilCompoWordpress-2.7.0/assets/field/field_big.png"></image>
                                    <image  height="790" id="lines" width="1150" x="0" y="20" xlink:href="https://www.demivolee.com/wp-content/plugins/OutilCompoWordpress-2.7.0/assets/field/lines.png"></image>
                                    
                                    <!-- Poste -->
                                    <g left="0" top="0" transform="matrix(1,0,0,1,0,20)" class="contents">
                                    
                                        <!-- Gardien -->
                                        <g transform="matrix(1,0,0,1,120,340)" class="gardien">
                                            <image height="70" left="0" preserveAspectRatio="none" top="0" width="70" x="0" y="0" xmlns:svg="http://www.w3.org/2000/svg"  xlink:href="/imgplayers/63c81eac05e1e9.90572581.png"></image>
                                            <g  xmlns:svg="http://www.w3.org/2000/svg" class="dropzone draggable">
                                                <rect fill="#21316a" height="39" rx="10" ry="10" width="140" x="-35" y="69"></rect>
                                                <text  fill="#ffffff" id="j1" left="0" top="0" transform="matrix(1,0,0,1,-25, 97)" class="text_joueur" style="font-size: 24px; font-family: Arial; text-anchor: start;"><?php echo $gardien ?></text>
                                            </g>
                                        </g>

                                        <!-- Défenseur Gauche -->
                                        <g transform="matrix(1,0,0,1,300,100)" class="dg">
                                            <image height="70" left="0" preserveAspectRatio="none" top="0" width="70" x="0" y="0" xmlns:svg="http://www.w3.org/2000/svg" xlink:href="https://www.demivolee.com/wp-content/plugins/OutilCompoWordpress-2.7.0/assets/maillot/neutre.png"></image>
                                            <g  xmlns:svg="http://www.w3.org/2000/svg" class="dropzone draggable">
                                                <rect fill="#21316a" height="39" rx="10" ry="10" width="140" x="-35" y="69"></rect>
                                                <text  fill="#ffffff" id="j3" left="0" top="0" transform="matrix(1,0,0,1,-25, 97)" class="text_joueur" style="font-size: 24px; font-family: Arial; text-anchor: start;"><?php echo $dg ?></text>
                                            </g>
                                        </g>

                                        <!-- Défenseur Centrale Gauche -->
                                        <g transform="matrix(1,0,0,1,300,260)" class="dcg">
                                            <image height="70" left="0" preserveAspectRatio="none" top="0" width="70" x="0" y="0" xmlns:svg="http://www.w3.org/2000/svg" xlink:href="https://www.demivolee.com/wp-content/plugins/OutilCompoWordpress-2.7.0/assets/maillot/neutre.png"></image>
                                            <g  xmlns:svg="http://www.w3.org/2000/svg" class="dropzone draggable">
                                                <rect fill="#21316a" height="39" rx="10" ry="10" width="140" x="-35" y="69"></rect>
                                                <text  fill="#ffffff" id="j5" left="0" top="0" transform="matrix(1,0,0,1,-25, 97)" class="text_joueur" style="font-size: 24px; font-family: Arial; text-anchor: start;"><?php echo $dcg ?></text>
                                            </g>
                                        </g>

                                        <!-- Défenseur Centrale Droit -->
                                        <g transform="matrix(1,0,0,1,300,420)" class="dcd">
                                            <image height="70" left="0" preserveAspectRatio="none" top="0" width="70" x="0" y="0" xmlns:svg="http://www.w3.org/2000/svg" xlink:href="https://www.demivolee.com/wp-content/plugins/OutilCompoWordpress-2.7.0/assets/maillot/neutre.png"></image>
                                            <g  xmlns:svg="http://www.w3.org/2000/svg" class="dropzone draggable">
                                                <rect fill="#21316a" height="39" rx="10" ry="10" width="140" x="-35" y="69"></rect>
                                                <text  fill="#ffffff" id="j4" left="0" top="0" transform="matrix(1,0,0,1,-25, 97)" class="text_joueur" style="font-size: 24px; font-family: Arial; text-anchor: start;"><?php echo $dcd ?></text>
                                            </g>
                                        </g>

                                        <!-- Défenseur Droit -->
                                        <g transform="matrix(1,0,0,1,300,580)" class="dd">
                                            <image height="70" left="0" preserveAspectRatio="none" top="0" width="70" x="0" y="0" xmlns:svg="http://www.w3.org/2000/svg" xlink:href="https://www.demivolee.com/wp-content/plugins/OutilCompoWordpress-2.7.0/assets/maillot/neutre.png"></image>
                                            <g  xmlns:svg="http://www.w3.org/2000/svg" class="dropzone draggable">
                                                <rect fill="#21316a" height="39" rx="10" ry="10" width="140" x="-35" y="69"></rect>
                                                <text  fill="#ffffff" id="j2" left="0" top="0" transform="matrix(1,0,0,1,-25, 97)" class="text_joueur" style="font-size: 24px; font-family: Arial; text-anchor: start;"><?php echo $dd ?></text>
                                            </g>
                                        </g>

                                        <!-- Milieu Défensif Gauche -->
                                        <g transform="matrix(1,0,0,1,540,175)" class="mdcg">
                                            <image height="70" left="0" preserveAspectRatio="none" top="0" width="70" x="0" y="0" xmlns:svg="http://www.w3.org/2000/svg" xlink:href="https://www.demivolee.com/wp-content/plugins/OutilCompoWordpress-2.7.0/assets/maillot/neutre.png"></image>
                                            <g  xmlns:svg="http://www.w3.org/2000/svg" class="dropzone draggable">
                                                <rect fill="#21316a" height="39" rx="10" ry="10" width="140" x="-35" y="69"></rect>
                                                <text  fill="#ffffff" id="j8" left="0" top="0" transform="matrix(1,0,0,1,-25, 97)" class="text_joueur" style="font-size: 24px; font-family: Arial; text-anchor: start;"><?php echo $mdcg ?></text>
                                            </g>
                                        </g>

                                        <!-- Milieu Défensif Droit -->
                                        <g transform="matrix(1,0,0,1,540,500)" class="mdcd">
                                            <image height="70" left="0" preserveAspectRatio="none" top="0" width="70" x="0" y="0" xmlns:svg="http://www.w3.org/2000/svg" xlink:href="https://www.demivolee.com/wp-content/plugins/OutilCompoWordpress-2.7.0/assets/maillot/neutre.png"></image>
                                            <g  xmlns:svg="http://www.w3.org/2000/svg" class="dropzone draggable">
                                                <rect fill="#21316a" height="39" rx="10" ry="10" width="140" x="-35" y="69"></rect>
                                                <text  fill="#ffffff" id="j6" left="0" top="0" transform="matrix(1,0,0,1,-25, 97)" class="text_joueur" style="font-size: 24px; font-family: Arial; text-anchor: start;"><?php echo $mdcd ?></text>
                                            </g>
                                        </g>

                                        <!-- Attaquant Gauche -->
                                        <g transform="matrix(1,0,0,1,800,100)" class="moc">
                                            <image height="70" left="0" preserveAspectRatio="none" top="0" width="70" x="0" y="0" xmlns:svg="http://www.w3.org/2000/svg" xlink:href="https://www.demivolee.com/wp-content/plugins/OutilCompoWordpress-2.7.0/assets/maillot/neutre.png"></image>
                                            <g  xmlns:svg="http://www.w3.org/2000/svg" class="dropzone draggable">
                                                <rect fill="#21316a" height="39" rx="10" ry="10" width="140" x="-35" y="69"></rect>
                                                <text  fill="#ffffff" id="j11" left="0" top="0" transform="matrix(1,0,0,1,-25, 97)" class="text_joueur" style="font-size: 24px; font-family: Arial; text-anchor: start;"><?php echo $ag ?></text>
                                            </g>
                                        </g>

                                        <!-- Attaquant Droit -->
                                        <g transform="matrix(1,0,0,1,800,580)" class="ag">
                                            <image height="70" left="0" preserveAspectRatio="none" top="0" width="70" x="0" y="0" xmlns:svg="http://www.w3.org/2000/svg" xlink:href="https://www.demivolee.com/wp-content/plugins/OutilCompoWordpress-2.7.0/assets/maillot/neutre.png"></image>
                                            <g  xmlns:svg="http://www.w3.org/2000/svg" class="dropzone draggable">
                                                <rect fill="#21316a" height="39" rx="10" ry="10" width="140" x="-35" y="69"></rect>
                                                <text  fill="#ffffff" id="j7" left="0" top="0" transform="matrix(1,0,0,1,-25, 97)" class="text_joueur" style="font-size: 24px; font-family: Arial; text-anchor: start;"><?php echo $ad ?></text>
                                            </g>
                                        </g>

                                        <!-- Milieu Offensif -->
                                        <g transform="matrix(1,0,0,1,700,340)" class="ad">
                                            <image height="70" left="0" preserveAspectRatio="none" top="0" width="70" x="0" y="0" xmlns:svg="http://www.w3.org/2000/svg" xlink:href="https://www.demivolee.com/wp-content/plugins/OutilCompoWordpress-2.7.0/assets/maillot/neutre.png"></image>
                                            <g  xmlns:svg="http://www.w3.org/2000/svg" class="dropzone draggable">
                                                <rect fill="#21316a" height="39" rx="10" ry="10" width="140" x="-35" y="69"></rect>
                                                <text  fill="#ffffff" id="j10" left="0" top="0" transform="matrix(1,0,0,1,-25, 97)" class="text_joueur" style="font-size: 24px; font-family: Arial; text-anchor: start;"><?php echo $moc ?></text>
                                            </g>   
                                        </g>

                                        <!-- Buteur -->
                                        <g transform="matrix(1,0,0,1,900,340)" class="bu">
                                            <image height="70" left="0" preserveAspectRatio="none" top="0" width="70" x="0" y="0" xmlns:svg="http://www.w3.org/2000/svg" xlink:href="https://www.demivolee.com/wp-content/plugins/OutilCompoWordpress-2.7.0/assets/maillot/neutre.png"></image>
                                            <g  xmlns:svg="http://www.w3.org/2000/svg" class="dropzone draggable">
                                                <rect fill="#21316a" height="39" rx="10" ry="10" width="140" x="-35" y="69"></rect>
                                                <text  fill="#ffffff" id="j9" left="0" top="0" transform="matrix(1,0,0,1,-25, 97)" class="text_joueur" style="font-size: 24px; font-family: Arial; text-anchor: start;"><?php echo $bu ?></text>
                                            </g>
                                        </g>

                                    </g>
                                </svg>
                            </div>
                            <span id = span-feuille><?php echo $info_execution?> </span>
                    </div>

                    <div class="container-droite">
                        <form action="<?php echo "feuillematch.php?id=" . $id ?>" method="post">

                            <div class="selection-joueur">

                                <h1>Joueurs titulaires</h1>
                                <hr>
                                <select class="select-joueur"name="gardien" id="gardien" <?php if($selectsFull) {echo 'disabled';} ?>>
                                    <option value="Joueur 1" selected>Joueur 1 (Gardien)</option>
                                    <?php
                                        //Affichage de la liste de tout les joueurs enregistrés dans la base de données
                                        while ($data = $reqGardien->fetch()) {
                                            if ($data['Poste'] == 'Gardien' and $data['Statut'] == 'Actif') {
                                                if ($gardien == $data['Nom']) {
                                                    echo '<option value="' . $data['Nom'] . '" selected>' . $data['Prenom'] . ' ' . $data['Nom'] . '</option>';
                                                } else {
                                                    echo '<option value="' . $data['Nom'] . '">' . $data['Prenom'] . ' ' . $data['Nom'] . '</option>';
                                                }
                                            }
                                        }
                                    ?>
                                </select>
                                <!-- Select caché pour récuperer la liste de tous les défenseurs -->
                                <select class="select-joueur" name="defenseurs" id="defenseurs">
                                    <?php
                                        //Affichage de la liste de tout les joueurs enregistrés dans la base de données
                                        while ($data = $reqDefenseurs->fetch()) {
                                            if ($data['Poste'] == 'Défenseur' and $data['Statut'] == 'Actif') { 
                                                    echo '<option value="' . $data['Nom'] . '">' . $data['Prenom'] . ' ' . $data['Nom'] . '</option>';     
                                            }               
                                        }
                                    ?>
                                </select>
                                <select class="select-joueur" name="dd" id="dd" <?php if($selectsFull) {echo 'disabled';} ?>>
                                    <option value="Joueur 2" selected>Joueur 2 (Défenseur)</option>
                                    <?php
                                        //Affichage de la liste de tout les joueurs enregistrés dans la base de données
                                        while ($data = $reqDD->fetch()) {
                                            if ($data['Poste'] == 'Défenseur' and $data['Statut'] == 'Actif') {
                                                if ($dd == $data['Nom']) {
                                                    echo '<option value="' . $data['Nom'] . '" selected>' . $data['Prenom'] . ' ' . $data['Nom'] . '</option>';
                                                } else {
                                                    echo '<option value="' . $data['Nom'] . '">' . $data['Prenom'] . ' ' . $data['Nom'] . '</option>';
                                                }
                                            }
                                        }
                                    ?>
                                </select>
                                <select class="select-joueur" name="dg" id="dg" <?php if($selectsFull) {echo 'disabled';} ?>>
                                    <option value="Joueur 3" selected>Joueur 3 (Défenseur)</option>
                                    <?php
                                        //Affichage de la liste de tout les joueurs enregistrés dans la base de données
                                        while ($data = $reqDG->fetch()) {
                                            if ($data['Poste'] == 'Défenseur' and $data['Statut'] == 'Actif') {
                                                if ($dg == $data['Nom']) {
                                                    echo '<option value="' . $data['Nom'] . '" selected>' . $data['Prenom'] . ' ' . $data['Nom'] . '</option>';
                                                } else {
                                                    echo '<option value="' . $data['Nom'] . '">' . $data['Prenom'] . ' ' . $data['Nom'] . '</option>';
                                                }
                                            }
                                        }
                                    ?>
                                </select>
                                <select class="select-joueur" name="dcd" id="dcd" <?php if($selectsFull) {echo 'disabled';} ?>>
                                    <option value="Joueur 4" selected>Joueur 4 (Défenseur)</option>
                                    <?php
                                        //Affichage de la liste de tout les joueurs enregistrés dans la base de données
                                        while ($data = $reqDCD->fetch()) {
                                            if ($data['Poste'] == 'Défenseur' and $data['Statut'] == 'Actif') {
                                                if ($dcd == $data['Nom']) {
                                                    echo '<option value="' . $data['Nom'] . '" selected>' . $data['Prenom'] . ' ' . $data['Nom'] . '</option>';
                                                } else {
                                                    echo '<option value="' . $data['Nom'] . '">' . $data['Prenom'] . ' ' . $data['Nom'] . '</option>';
                                                }
                                            }
                                        }
                                    ?>
                                </select>
                                <select class="select-joueur" name="dcg" id="dcg" <?php if($selectsFull) {echo 'disabled';} ?>>
                                    <option value="Joueur 5" selected>Joueur 5 (Défenseur)</option>
                                    <?php
                                        //Affichage de la liste de tout les joueurs enregistrés dans la base de données
                                        while ($data = $reqDCG->fetch()) {
                                            if ($data['Poste'] == 'Défenseur' and $data['Statut'] == 'Actif') {
                                                if ($dcg == $data['Nom']) {
                                                    echo '<option value="' . $data['Nom'] . '" selected>' . $data['Prenom'] . ' ' . $data['Nom'] . '</option>';
                                                } else {
                                                    echo '<option value="' . $data['Nom'] . '">' . $data['Prenom'] . ' ' . $data['Nom'] . '</option>';
                                                }
                                            }
                                        }
                                    ?>
                                </select>
                                <select class="select-joueur" name="mdcd" id="mdcd" <?php if($selectsFull) {echo 'disabled';} ?>>
                                    <option value="Joueur 6" selected>Joueur 6 (Milieu)</option>
                                    <?php
                                        //Affichage de la liste de tout les joueurs enregistrés dans la base de données
                                        while ($data = $reqMDCD->fetch()) {
                                            if ($data['Poste'] == 'Milieu' and $data['Statut'] == 'Actif') {
                                                if ($mdcd == $data['Nom']) {
                                                    echo '<option value="' . $data['Nom'] . '" selected>' . $data['Prenom'] . ' ' . $data['Nom'] . '</option>';
                                                } else {
                                                    echo '<option value="' . $data['Nom'] . '">' . $data['Prenom'] . ' ' . $data['Nom'] . '</option>';
                                                }
                                            }
                                        }
                                    ?>
                                </select>
                                <!-- Select caché pour récuperer la liste de tous les milieux -->
                                <select class="select-joueur" name="milieu" id="milieu">
                                    <?php
                                        //Affichage de la liste de tout les joueurs enregistrés dans la base de données
                                        while ($data = $reqMilieux->fetch()) {
                                            if ($data['Poste'] == 'Milieu' and $data['Statut'] == 'Actif') {
                                                echo '<option value="' . $data['Nom'] . '">' . $data['Prenom'] . ' ' . $data['Nom'] . '</option>';
                                            }
                                        }
                                    ?>
                                </select>
                                <select class="select-joueur" name="ad" id="ad" <?php if($selectsFull) {echo 'disabled';} ?>>
                                    <option value="Joueur 7" selected>Joueur 7 (Attaquant)</option>
                                    <?php
                                        //Affichage de la liste de tout les joueurs enregistrés dans la base de données
                                        while ($data = $reqAD->fetch()) {
                                            if ($data['Poste'] == 'Attaquant' and $data['Statut'] == 'Actif') {
                                                if ($ad == $data['Nom']) {
                                                    echo '<option value="' . $data['Nom'] . '" selected>' . $data['Prenom'] . ' ' . $data['Nom'] . '</option>';
                                                } else {
                                                    echo '<option value="' . $data['Nom'] . '">' . $data['Prenom'] . ' ' . $data['Nom'] . '</option>';
                                                }
                                            }
                                        }
                                    ?>
                                </select>
                                <select class="select-joueur" name="mdcg" id="mdcg" <?php if($selectsFull) {echo 'disabled';} ?>>
                                    <option value="Joueur 8" selected>Joueur 8 (Milieu)</option>
                                    <?php
                                        //Affichage de la liste de tout les joueurs enregistrés dans la base de données
                                        while ($data = $reqMDCG->fetch()) {
                                            if ($data['Poste'] == 'Milieu' and $data['Statut'] == 'Actif') {
                                                if ($mdcg == $data['Nom']) {
                                                    echo '<option value="' . $data['Nom'] . '" selected>' . $data['Prenom'] . ' ' . $data['Nom'] . '</option>';
                                                } else {
                                                    echo '<option value="' . $data['Nom'] . '">' . $data['Prenom'] . ' ' . $data['Nom'] . '</option>';
                                                }
                                            }
                                        }
                                    ?>
                                </select>
                                <select class="select-joueur" name="bu" id="bu" <?php if($selectsFull) {echo 'disabled';} ?>>
                                    <option value="Joueur 9" selected>Joueur 9 (Attaquant)</option>
                                    <?php
                                        //Affichage de la liste de tout les joueurs enregistrés dans la base de données
                                        while ($data = $reqBU->fetch()) {
                                            if ($data['Poste'] == 'Attaquant' and $data['Statut'] == 'Actif') {
                                                if ($bu == $data['Nom']) {
                                                    echo '<option value="' . $data['Nom'] . '" selected>' . $data['Prenom'] . ' ' . $data['Nom'] . '</option>';
                                                } else {
                                                    echo '<option value="' . $data['Nom'] . '">' . $data['Prenom'] . ' ' . $data['Nom'] . '</option>';
                                                }
                                            }
                                        }
                                    ?>
                                </select>
                                <select class="select-joueur" name="moc" id="moc" <?php if($selectsFull) {echo 'disabled';} ?>>
                                    <option value="Joueur 10" selected>Joueur 10 (Milieu)</option>
                                    <?php
                                        //Affichage de la liste de tout les joueurs enregistrés dans la base de données
                                        while ($data = $reqMOC->fetch()) {
                                            if ($data['Poste'] == 'Milieu' and $data['Statut'] == 'Actif') {
                                                if ($moc == $data['Nom']) {
                                                    echo '<option value="' . $data['Nom'] . '" selected>' . $data['Prenom'] . ' ' . $data['Nom'] . '</option>';
                                                } else {
                                                    echo '<option value="' . $data['Nom'] . '">' . $data['Prenom'] . ' ' . $data['Nom'] . '</option>';
                                                }
                                            }
                                        }
                                    ?>
                                </select>
                                <!-- Select caché pour récuperer la liste de tous les atttaquants -->
                                <select class="select-joueur" name="attaquants" id="attaquants">
                                    <?php
                                        //Affichage de la liste de tout les joueurs enregistrés dans la base de données
                                        while ($data = $reqAttaquants->fetch()) {
                                            if ($data['Poste'] == 'Attaquant' and $data['Statut'] == 'Actif') {
                                                    echo '<option value="' . $data['Nom'] . '">' . $data['Prenom'] . ' ' . $data['Nom'] . '</option>';
                                            }
                                        }
                                    ?>
                                </select>
                                <select class="select-joueur" name="ag" id="ag" <?php if($selectsFull) {echo 'disabled';} ?>>
                                    <option value="Joueur 11" selected>Joueur 11 (Attaquant)</option>
                                    <?php
                                        //Affichage de la liste de tout les joueurs enregistrés dans la base de données
                                        while ($data = $reqAG->fetch()) {
                                            if ($data['Poste'] == 'Attaquant' and $data['Statut'] == 'Actif') {
                                                if ($ag == $data['Nom']) {
                                                    echo '<option value="' . $data['Nom'] . '" selected>' . $data['Prenom'] . ' ' . $data['Nom'] . '</option>';
                                                } else {
                                                    echo '<option value="' . $data['Nom'] . '">' . $data['Prenom'] . ' ' . $data['Nom'] . '</option>';
                                                }
                                            }
                                        }
                                    ?>
                                </select>
                                <input type="submit" class="submit submit-feuille" name="Valider" value="Valider" <?php if($selectsFull) {echo 'disabled';} ?>>
                                <input type="submit" class="submit supprimer" name="Supprimer" value="Supprimer">
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </main>
        <!-- PARTIE JAVA SCRIPT -->
        <!-- Script pour insérer les joueurs dans les balises text depuis les select dynamiquement  et pour empêcher de pouvoir choisir deux fois le même choisir dans deux select différent-->
        <script>

            var gardien = document.getElementById("gardien");
            var textj1 = document.getElementById("j1");

            //Récupération du select avec la liste des défenseurs (qu'on cache avec display none)
            var defenseurs = document.getElementById("defenseurs");
            defenseurs.style.display = "none";
            var options = defenseurs.querySelectorAll("option");

            var dd = document.getElementById("dd");
            var textj2 = document.getElementById("j2");
            let selectedOptionDD;

            var dg = document.getElementById("dg");
            var textj3 = document.getElementById("j3");
            let selectedOptionDG;

            var dcd = document.getElementById("dcd");
            var textj4 = document.getElementById("j4");
            let selectedOptionDCD;

            var dcg = document.getElementById("dcg");
            var textj5 = document.getElementById("j5");
            let selectedOptionDCG;

            //Récupération du select avec la liste des milieux (qu'on cache avec display none)
            var milieux = document.getElementById("milieu");
            milieux.style.display = "none";
            var optionsMilieux = milieux.querySelectorAll("option");

            var mdcd = document.getElementById("mdcd");
            var textj6 = document.getElementById("j6");
            let selectedOptionMDCD;

            var mdcg = document.getElementById("mdcg");
            var textj8 = document.getElementById("j8");
            let selectedOptionMDCG;

            var moc = document.getElementById("moc");
            var textj10 = document.getElementById("j10");
            let selectedOptionMOC;

            //Récupération du select avec la liste des milieux (qu'on cache avec display none)
            var attaquants = document.getElementById("attaquants");
            attaquants.style.display = "none";
            var optionsAttaquants = attaquants.querySelectorAll("option");

            var bu = document.getElementById("bu");
            var textj9 = document.getElementById("j9");
            let selectedOptionBU;

            var ad = document.getElementById("ad");
            var textj7 = document.getElementById("j7");
            let selectedOptionAD;

            var ag = document.getElementById("ag");
            var textj11 = document.getElementById("j11");
            let selectedOptionAG;
                                        
            //Changement dynamique quand on clique sur le select du joueur1
            gardien.addEventListener("change", function() {
                textj1.innerHTML = gardien.value;
            });

            //Changement dynamique quand on clique sur le select du joueur2
            dd.addEventListener("change", function() {
                textj2.innerHTML = dd.value;
                selectedOptionDD = dd.options[dd.selectedIndex].value;
             
                //DG
                for (let i = dg.options.length - 1; i > 0; i--) {
                    dg.remove(i);
                }

                for (var i = 0; i < options.length; i++) {
                    if (options[i].value !== selectedOptionDD && options[i].value !== selectedOptionDCD && options[i].value !== selectedOptionDCG)  
                        if (options[i].value === selectedOptionDG) {
                            dg.innerHTML += "<option value='" + options[i].value + "' selected>" + options[i].text + "</option>";
                        } else {
                            dg.innerHTML += "<option value='" + options[i].value + "'>" + options[i].text + "</option>";
                        }
                }
                
                //DCD 
                for (let i = dcd.options.length - 1; i > 0; i--) {
                    dcd.remove(i);
                }
                
                for (var i = 0; i < options.length; i++) {
                    if (options[i].value !== selectedOptionDD && options[i].value !== selectedOptionDG && options[i].value !== selectedOptionDCG)  
                        if (options[i].value === selectedOptionDCD) {
                            dcd.innerHTML += "<option value='" + options[i].value + "' selected>" + options[i].text + "</option>";
                        } else {
                            dcd.innerHTML += "<option value='" + options[i].value + "'>" + options[i].text + "</option>";
                        }
                } 

                //DCG 
                for (let i = dcg.options.length - 1; i > 0; i--) {
                    dcg.remove(i);
                }
                
                for (var i = 0; i < options.length; i++) {
                    if (options[i].value !== selectedOptionDD && options[i].value !== selectedOptionDCD && options[i].value !== selectedOptionDG)  
                        if (options[i].value === selectedOptionDCG) {
                            dcg.innerHTML += "<option value='" + options[i].value + "' selected>" + options[i].text + "</option>";
                        } else {
                            dcg.innerHTML += "<option value='" + options[i].value + "'>" + options[i].text + "</option>";
                        }
                } 
            });

            dg.addEventListener("change", function() {
                textj3.innerHTML = dg.value;
                selectedOptionDG = dg.options[dg.selectedIndex].value;
             
                //DD
                for (let i = dd.options.length - 1; i > 0; i--) {
                    dd.remove(i);
                }

                for (var i = 0; i < options.length; i++) {
                    if (options[i].value !== selectedOptionDG && options[i].value !== selectedOptionDCD && options[i].value !== selectedOptionDCG)
                        if (options[i].value === selectedOptionDD) {
                            dd.innerHTML += "<option value='" + options[i].value + "' selected>" + options[i].text + "</option>";
                        } else {
                            dd.innerHTML += "<option value='" + options[i].value + "'>" + options[i].text + "</option>";
                        }
                }
                
                //DCD 
                for (let i = dcd.options.length - 1; i > 0; i--) {
                    dcd.remove(i);
                }
                
                for (var i = 0; i < options.length; i++) {
                    if (options[i].value !== selectedOptionDD && options[i].value !== selectedOptionDG && options[i].value !== selectedOptionDCG)  
                        if (options[i].value === selectedOptionDCD) {
                            dcd.innerHTML += "<option value='" + options[i].value + "' selected>" + options[i].text + "</option>";
                        } else {
                            dcd.innerHTML += "<option value='" + options[i].value + "'>" + options[i].text + "</option>";
                        }
                } 

                //DCG 
                for (let i = dcg.options.length - 1; i > 0; i--) {
                    dcg.remove(i);
                }
                
                for (var i = 0; i < options.length; i++) {
                    if (options[i].value !== selectedOptionDD && options[i].value !== selectedOptionDCD && options[i].value !== selectedOptionDG)  
                        if (options[i].value === selectedOptionDCG) {
                            dcg.innerHTML += "<option value='" + options[i].value + "' selected>" + options[i].text + "</option>";
                        } else {
                            dcg.innerHTML += "<option value='" + options[i].value + "'>" + options[i].text + "</option>";
                        }
                } 

            });

            dcd.addEventListener("change", function() {
                textj4.innerHTML = dcd.value;
                selectedOptionDCD = dcd.options[dcd.selectedIndex].value;

                //DD
                for (let i = dd.options.length - 1; i > 0; i--) {
                    dd.remove(i);
                }

                for (var i = 0; i < options.length; i++) {
                    if (options[i].value !== selectedOptionDG && options[i].value !== selectedOptionDCD && options[i].value !== selectedOptionDCG)
                        if (options[i].value === selectedOptionDD) {
                            dd.innerHTML += "<option value='" + options[i].value + "' selected>" + options[i].text + "</option>";
                        } else {
                            dd.innerHTML += "<option value='" + options[i].value + "'>" + options[i].text + "</option>";
                        }
                }
                
                //DG
                for (let i = dg.options.length - 1; i > 0; i--) {
                    dg.remove(i);
                }

                for (var i = 0; i < options.length; i++) {
                    if (options[i].value !== selectedOptionDD && options[i].value !== selectedOptionDCD && options[i].value !== selectedOptionDCG)  
                        if (options[i].value === selectedOptionDG) {
                            dg.innerHTML += "<option value='" + options[i].value + "' selected>" + options[i].text + "</option>";
                        } else {
                            dg.innerHTML += "<option value='" + options[i].value + "'>" + options[i].text + "</option>";
                        }
                }

                //DCG 
                for (let i = dcg.options.length - 1; i > 0; i--) {
                    dcg.remove(i);
                }
                
                for (var i = 0; i < options.length; i++) {
                    if (options[i].value !== selectedOptionDD && options[i].value !== selectedOptionDCD && options[i].value !== selectedOptionDG)  
                        if (options[i].value === selectedOptionDCG) {
                            dcg.innerHTML += "<option value='" + options[i].value + "' selected>" + options[i].text + "</option>";
                        } else {
                            dcg.innerHTML += "<option value='" + options[i].value + "'>" + options[i].text + "</option>";
                        }
                } 

            });

            dcg.addEventListener("change", function() {
                textj5.innerHTML = dcg.value;
                selectedOptionDCG = dcg.options[dcg.selectedIndex].value;

                ///DD
                for (let i = dd.options.length - 1; i > 0; i--) {
                    dd.remove(i);
                }

                for (var i = 0; i < options.length; i++) {
                    if (options[i].value !== selectedOptionDG && options[i].value !== selectedOptionDCD && options[i].value !== selectedOptionDCG)
                        if (options[i].value === selectedOptionDD) {
                            dd.innerHTML += "<option value='" + options[i].value + "' selected>" + options[i].text + "</option>";
                        } else {
                            dd.innerHTML += "<option value='" + options[i].value + "'>" + options[i].text + "</option>";
                        }
                }
                
                //DG
                for (let i = dg.options.length - 1; i > 0; i--) {
                    dg.remove(i);
                }

                for (var i = 0; i < options.length; i++) {
                    if (options[i].value !== selectedOptionDD && options[i].value !== selectedOptionDCD && options[i].value !== selectedOptionDCG)  
                        if (options[i].value === selectedOptionDG) {
                            dg.innerHTML += "<option value='" + options[i].value + "' selected>" + options[i].text + "</option>";
                        } else {
                            dg.innerHTML += "<option value='" + options[i].value + "'>" + options[i].text + "</option>";
                        }
                }

                //DCD 
                for (let i = dcd.options.length - 1; i > 0; i--) {
                    dcd.remove(i);
                }
                
                for (var i = 0; i < options.length; i++) {
                    if (options[i].value !== selectedOptionDD && options[i].value !== selectedOptionDCG && options[i].value !== selectedOptionDG)  
                        if (options[i].value === selectedOptionDCD) {
                            dcd.innerHTML += "<option value='" + options[i].value + "' selected>" + options[i].text + "</option>";
                        } else {
                            dcd.innerHTML += "<option value='" + options[i].value + "'>" + options[i].text + "</option>";
                        }
                } 
            });

            mdcd.addEventListener("change", function() {
                textj6.innerHTML = mdcd.value;
                selectedOptionMDCD = mdcd.options[mdcd.selectedIndex].value;
             
                //MDCG
                for (let i = mdcg.options.length - 1; i > 0; i--) {
                mdcg.remove(i);
                }

                for (var i = 0; i < optionsMilieux.length; i++) {
                    if (optionsMilieux[i].value !== selectedOptionMDCD && optionsMilieux[i].value !== selectedOptionMOC)  
                        if (optionsMilieux[i].value === selectedOptionMDCG) {
                            mdcg.innerHTML += "<option value='" + optionsMilieux[i].value + "' selected>" + optionsMilieux[i].text + "</option>";
                        } else {
                            mdcg.innerHTML += "<option value='" + optionsMilieux[i].value + "'>" + optionsMilieux[i].text + "</option>";
                        }
                }
                
                //MOC
                for (let i = moc.options.length - 1; i > 0; i--) {
                    moc.remove(i);
                }
                
                for (var i = 0; i < optionsMilieux.length; i++) {
                    if (optionsMilieux[i].value !== selectedOptionMDCD && optionsMilieux[i].value !== selectedOptionMDCG)  
                        if (optionsMilieux[i].value === selectedOptionMOC) {
                            moc.innerHTML += "<option value='" + optionsMilieux[i].value + "' selected>" + optionsMilieux[i].text + "</option>";
                        } else {
                            moc.innerHTML += "<option value='" + optionsMilieux[i].value + "'>" + optionsMilieux[i].text + "</option>";
                        }
                }
            });

            ad.addEventListener("change", function() {
                textj7.innerHTML = ad.value;
                selectedOptionAD = ad.options[ad.selectedIndex].value;
             
                //AG
                for (let i = ag.options.length - 1; i > 0; i--) {
                ag.remove(i);
                }

                for (var i = 0; i < optionsAttaquants.length; i++) {
                    if (optionsAttaquants[i].value !== selectedOptionAD && optionsAttaquants[i].value !== selectedOptionBU)  
                        if (optionsAttaquants[i].value === selectedOptionAG) {
                            ag.innerHTML += "<option value='" + optionsAttaquants[i].value + "' selected>" + optionsAttaquants[i].text + "</option>";
                        } else {
                            ag.innerHTML += "<option value='" + optionsAttaquants[i].value + "'>" + optionsAttaquants[i].text + "</option>";
                        }
                }
                
                //BU
                for (let i = bu.options.length - 1; i > 0; i--) {
                    bu.remove(i);
                }
                
                for (var i = 0; i < optionsAttaquants.length; i++) {
                    if (optionsAttaquants[i].value !== selectedOptionAD && optionsAttaquants[i].value !== selectedOptionAG)  
                        if (optionsAttaquants[i].value === selectedOptionBU) {
                            bu.innerHTML += "<option value='" + optionsAttaquants[i].value + "' selected>" + optionsAttaquants[i].text + "</option>";
                        } else {
                            bu.innerHTML += "<option value='" + optionsAttaquants[i].value + "'>" + optionsAttaquants[i].text + "</option>";
                        }
                }
            });

            mdcg.addEventListener("change", function() {
                textj8.innerHTML = mdcg.value;
                selectedOptionMDCG = mdcg.options[mdcg.selectedIndex].value;
             
                //MDCD
                for (let i = mdcd.options.length - 1; i > 0; i--) {
                mdcd.remove(i);
                }

                for (var i = 0; i < optionsMilieux.length; i++) {
                    if (optionsMilieux[i].value !== selectedOptionMDCG && optionsMilieux[i].value !== selectedOptionMOC)  
                        if (optionsMilieux[i].value === selectedOptionMDCD) {
                            mdcd.innerHTML += "<option value='" + optionsMilieux[i].value + "' selected>" + optionsMilieux[i].text + "</option>";
                        } else {
                            mdcd.innerHTML += "<option value='" + optionsMilieux[i].value + "'>" + optionsMilieux[i].text + "</option>";
                        }
                }
                
                //MOC
                for (let i = moc.options.length - 1; i > 0; i--) {
                    moc.remove(i);
                }
                
                for (var i = 0; i < optionsMilieux.length; i++) {
                    if (optionsMilieux[i].value !== selectedOptionMDCD && optionsMilieux[i].value !== selectedOptionMDCG)  
                        if (optionsMilieux[i].value === selectedOptionMOC) {
                            moc.innerHTML += "<option value='" + optionsMilieux[i].value + "' selected>" + optionsMilieux[i].text + "</option>";
                        } else {
                            moc.innerHTML += "<option value='" + optionsMilieux[i].value + "'>" + optionsMilieux[i].text + "</option>";
                        }
                }
            });

           bu.addEventListener("change", function() {
                textj9.innerHTML = bu.value;
                selectedOptionBU = bu.options[bu.selectedIndex].value;
             
                //AG
                for (let i = ag.options.length - 1; i > 0; i--) {
                ag.remove(i);
                }

                for (var i = 0; i < optionsAttaquants.length; i++) {
                    if (optionsAttaquants[i].value !== selectedOptionAD && optionsAttaquants[i].value !== selectedOptionBU)  
                        if (optionsAttaquants[i].value === selectedOptionAG) {
                            ag.innerHTML += "<option value='" + optionsAttaquants[i].value + "' selected>" + optionsAttaquants[i].text + "</option>";
                        } else {
                            ag.innerHTML += "<option value='" + optionsAttaquants[i].value + "'>" + optionsAttaquants[i].text + "</option>";
                        }
                }
                
                //AD
                for (let i = ad.options.length - 1; i > 0; i--) {
                    ad.remove(i);
                }
                
                for (var i = 0; i < optionsAttaquants.length; i++) {
                    if (optionsAttaquants[i].value !== selectedOptionBU && optionsAttaquants[i].value !== selectedOptionAG)  
                        if (optionsAttaquants[i].value === selectedOptionAD) {
                            ad.innerHTML += "<option value='" + optionsAttaquants[i].value + "' selected>" + optionsAttaquants[i].text + "</option>";
                        } else {
                            ad.innerHTML += "<option value='" + optionsAttaquants[i].value + "'>" + optionsAttaquants[i].text + "</option>";
                        }
                }
            });

            moc.addEventListener("change", function() {
                textj10.innerHTML = moc.value;
                selectedOptionMOC = moc.options[moc.selectedIndex].value;
             
                //MDCD
                for (let i = mdcd.options.length - 1; i > 0; i--) {
                mdcd.remove(i);
                }

                for (var i = 0; i < optionsMilieux.length; i++) {
                    if (optionsMilieux[i].value !== selectedOptionMDCG && optionsMilieux[i].value !== selectedOptionMOC)  
                        if (optionsMilieux[i].value === selectedOptionMDCD) {
                            mdcd.innerHTML += "<option value='" + optionsMilieux[i].value + "' selected>" + optionsMilieux[i].text + "</option>";
                        } else {
                            mdcd.innerHTML += "<option value='" + optionsMilieux[i].value + "'>" + optionsMilieux[i].text + "</option>";
                        }
                }

                //MDCG
                for (let i = mdcg.options.length - 1; i > 0; i--) {
                mdcg.remove(i);
                }

                for (var i = 0; i < optionsMilieux.length; i++) {
                    if (optionsMilieux[i].value !== selectedOptionMDCD && optionsMilieux[i].value !== selectedOptionMOC)  
                        if (optionsMilieux[i].value === selectedOptionMDCG) {
                            mdcg.innerHTML += "<option value='" + optionsMilieux[i].value + "' selected>" + optionsMilieux[i].text + "</option>";
                        } else {
                            mdcg.innerHTML += "<option value='" + optionsMilieux[i].value + "'>" + optionsMilieux[i].text + "</option>";
                        }
                }
            });

            ag.addEventListener("change", function() {
                textj11.innerHTML = ag.value;
                selectedOptionAG = ag.options[ag.selectedIndex].value;
                
                //AD
                for (let i = ad.options.length - 1; i > 0; i--) {
                    ad.remove(i);
                }
                
                for (var i = 0; i < optionsAttaquants.length; i++) {
                    if (optionsAttaquants[i].value !== selectedOptionBU && optionsAttaquants[i].value !== selectedOptionAG)  
                        if (optionsAttaquants[i].value === selectedOptionAD) {
                            ad.innerHTML += "<option value='" + optionsAttaquants[i].value + "' selected>" + optionsAttaquants[i].text + "</option>";
                        } else {
                            ad.innerHTML += "<option value='" + optionsAttaquants[i].value + "'>" + optionsAttaquants[i].text + "</option>";
                        }
                }

                //BU
                for (let i = bu.options.length - 1; i > 0; i--) {
                    bu.remove(i);
                }
                
                for (var i = 0; i < optionsAttaquants.length; i++) {
                    if (optionsAttaquants[i].value !== selectedOptionAD && optionsAttaquants[i].value !== selectedOptionAG)  
                        if (optionsAttaquants[i].value === selectedOptionBU) {
                            bu.innerHTML += "<option value='" + optionsAttaquants[i].value + "' selected>" + optionsAttaquants[i].text + "</option>";
                        } else {
                            bu.innerHTML += "<option value='" + optionsAttaquants[i].value + "'>" + optionsAttaquants[i].text + "</option>";
                        }
                }
            });
        </script>
    </body>
</html>