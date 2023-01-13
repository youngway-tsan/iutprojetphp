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
        $reqGardien = $sql->getJoueurs();
        $reqDD = $sql->getJoueurs();
        $reqDG = $sql->getJoueurs();
        $reqDCD = $sql->getJoueurs();
        $reqDCG = $sql->getJoueurs();
        $reqMDCD = $sql->getJoueurs();
        $reqAD = $sql->getJoueurs();

        //Initialisation de variables
        if (empty($_POST['gardien'])) {
            $gardien = "Joueur 1";
        } else {
            $gardien = $_POST['gardien'];
        }

        if (empty($_POST['dg'])) {
            $dg = "Joueur 3";
        } else {
            $dg = $_POST['dg'];
        }

        if (empty($_POST['dcg'])) {
            $dcg = "Joueur 5";;
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

        $mdcg = "Joueur 8";
        $mdcd = "Joueur 6";
        $moc= "Joueur 10";
        $ag= "Joueur 11";
        $ad= "Joueur 7";
        $bu= "Joueur 9";


        $id = $_GET['id'];
        $reqMatchId = $sql->matchId($id);
        while ($row = $reqMatchId->fetch()) {
            $datetime = $row['Date_Rencontre'];
            $nomAdversaire = $row['Nom_Equipe_Adverse'];
            $lieu = $row['Lieu_Rencontre'];
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
                                            <image height="70" left="0" preserveAspectRatio="none" top="0" width="70" x="0" y="0" xmlns:svg="http://www.w3.org/2000/svg"  xlink:href="https://www.demivolee.com/wp-content/plugins/OutilCompoWordpress-2.7.0/assets/maillot/neutre.png"></image>
                                            <g  xmlns:svg="http://www.w3.org/2000/svg" class="dropzone draggable">
                                                <rect fill="#21316a" height="39" rx="10" ry="10" width="140" x="-35" y="69"></rect>
                                                <text  fill="#ffffff" id="j0" left="0" top="0" transform="matrix(1,0,0,1,-25, 97)" class="text_joueur" style="font-size: 24px; font-family: Arial; text-anchor: start;"><?php echo $gardien ?></text>
                                            </g>
                                        </g>

                                        <!-- Défenseur Gauche -->
                                        <g transform="matrix(1,0,0,1,300,100)" class="dg">
                                            <image height="70" left="0" preserveAspectRatio="none" top="0" width="70" x="0" y="0" xmlns:svg="http://www.w3.org/2000/svg" xlink:href="https://www.demivolee.com/wp-content/plugins/OutilCompoWordpress-2.7.0/assets/maillot/neutre.png"></image>
                                            <g  xmlns:svg="http://www.w3.org/2000/svg" class="dropzone draggable">
                                                <rect fill="#21316a" height="39" rx="10" ry="10" width="140" x="-35" y="69"></rect>
                                                <text  fill="#ffffff" id="j0" left="0" top="0" transform="matrix(1,0,0,1,-25, 97)" class="text_joueur" style="font-size: 24px; font-family: Arial; text-anchor: start;"><?php echo $dg ?></text>
                                            </g>
                                        </g>

                                        <!-- Défenseur Centrale Gauche -->
                                        <g id="g_j0" transform="matrix(1,0,0,1,300,260)" class="dcg">
                                            <image height="70" left="0" preserveAspectRatio="none" top="0" width="70" x="0" y="0" xmlns:svg="http://www.w3.org/2000/svg" xlink:href="https://www.demivolee.com/wp-content/plugins/OutilCompoWordpress-2.7.0/assets/maillot/neutre.png"></image>
                                            <g  xmlns:svg="http://www.w3.org/2000/svg" class="dropzone draggable">
                                                <rect fill="#21316a" height="39" rx="10" ry="10" width="140" x="-35" y="69"></rect>
                                                <text  fill="#ffffff" id="j0" left="0" top="0" transform="matrix(1,0,0,1,-25, 97)" class="text_joueur" style="font-size: 24px; font-family: Arial; text-anchor: start;"><?php echo $dcg ?></text>
                                            </g>
                                        </g>

                                        <!-- Défenseur Centrale Droit -->
                                        <g id="g_j0" transform="matrix(1,0,0,1,300,420)" class="dcd">
                                            <image height="70" left="0" preserveAspectRatio="none" top="0" width="70" x="0" y="0" xmlns:svg="http://www.w3.org/2000/svg" xlink:href="https://www.demivolee.com/wp-content/plugins/OutilCompoWordpress-2.7.0/assets/maillot/neutre.png"></image>
                                            <g  xmlns:svg="http://www.w3.org/2000/svg" class="dropzone draggable">
                                                <rect fill="#21316a" height="39" rx="10" ry="10" width="140" x="-35" y="69"></rect>
                                                <text  fill="#ffffff" id="j0" left="0" top="0" transform="matrix(1,0,0,1,-25, 97)" class="text_joueur" style="font-size: 24px; font-family: Arial; text-anchor: start;"><?php echo $dcd ?></text>
                                            </g>
                                        </g>

                                        <!-- Défenseur Droit -->
                                        <g id="g_j0" transform="matrix(1,0,0,1,300,580)" class="dd">
                                            <image height="70" left="0" preserveAspectRatio="none" top="0" width="70" x="0" y="0" xmlns:svg="http://www.w3.org/2000/svg" xlink:href="https://www.demivolee.com/wp-content/plugins/OutilCompoWordpress-2.7.0/assets/maillot/neutre.png"></image>
                                            <g  xmlns:svg="http://www.w3.org/2000/svg" class="dropzone draggable">
                                                <rect fill="#21316a" height="39" rx="10" ry="10" width="140" x="-35" y="69"></rect>
                                                <text  fill="#ffffff" id="j0" left="0" top="0" transform="matrix(1,0,0,1,-25, 97)" class="text_joueur" style="font-size: 24px; font-family: Arial; text-anchor: start;"><?php echo $dd ?></text>
                                            </g>
                                        </g>

                                        <!-- Milieu Défensif Gauche -->
                                        <g id="g_j0" transform="matrix(1,0,0,1,540,175)" class="mdcg">
                                            <image height="70" left="0" preserveAspectRatio="none" top="0" width="70" x="0" y="0" xmlns:svg="http://www.w3.org/2000/svg" xlink:href="https://www.demivolee.com/wp-content/plugins/OutilCompoWordpress-2.7.0/assets/maillot/neutre.png"></image>
                                            <g  xmlns:svg="http://www.w3.org/2000/svg" class="dropzone draggable">
                                                <rect fill="#21316a" height="39" rx="10" ry="10" width="140" x="-35" y="69"></rect>
                                                <text  fill="#ffffff" id="j0" left="0" top="0" transform="matrix(1,0,0,1,-25, 97)" class="text_joueur" style="font-size: 24px; font-family: Arial; text-anchor: start;"><?php echo $mdcg ?></text>
                                            </g>
                                        </g>

                                        <!-- Milieu Défensif Droit -->
                                        <g id="g_j0" transform="matrix(1,0,0,1,540,500)" class="mdcd">
                                            <image height="70" left="0" preserveAspectRatio="none" top="0" width="70" x="0" y="0" xmlns:svg="http://www.w3.org/2000/svg" xlink:href="https://www.demivolee.com/wp-content/plugins/OutilCompoWordpress-2.7.0/assets/maillot/neutre.png"></image>
                                            <g  xmlns:svg="http://www.w3.org/2000/svg" class="dropzone draggable">
                                                <rect fill="#21316a" height="39" rx="10" ry="10" width="140" x="-35" y="69"></rect>
                                                <text  fill="#ffffff" id="j0" left="0" top="0" transform="matrix(1,0,0,1,-25, 97)" class="text_joueur" style="font-size: 24px; font-family: Arial; text-anchor: start;"><?php echo $mdcd ?></text>
                                            </g>
                                        </g>

                                        <!-- Attaquant Gauche -->
                                        <g id="g_j0" transform="matrix(1,0,0,1,800,100)" class="moc">
                                            <image height="70" left="0" preserveAspectRatio="none" top="0" width="70" x="0" y="0" xmlns:svg="http://www.w3.org/2000/svg" xlink:href="https://www.demivolee.com/wp-content/plugins/OutilCompoWordpress-2.7.0/assets/maillot/neutre.png"></image>
                                            <g  xmlns:svg="http://www.w3.org/2000/svg" class="dropzone draggable">
                                                <rect fill="#21316a" height="39" rx="10" ry="10" width="140" x="-35" y="69"></rect>
                                                <text  fill="#ffffff" id="j0" left="0" top="0" transform="matrix(1,0,0,1,-25, 97)" class="text_joueur" style="font-size: 24px; font-family: Arial; text-anchor: start;"><?php echo $ag ?></text>
                                            </g>
                                        </g>

                                        <!-- Attaquant Droit -->
                                        <g id="g_j0" transform="matrix(1,0,0,1,800,580)" class="ag">
                                            <image height="70" left="0" preserveAspectRatio="none" top="0" width="70" x="0" y="0" xmlns:svg="http://www.w3.org/2000/svg" xlink:href="https://www.demivolee.com/wp-content/plugins/OutilCompoWordpress-2.7.0/assets/maillot/neutre.png"></image>
                                            <g  xmlns:svg="http://www.w3.org/2000/svg" class="dropzone draggable">
                                                <rect fill="#21316a" height="39" rx="10" ry="10" width="140" x="-35" y="69"></rect>
                                                <text  fill="#ffffff" id="j0" left="0" top="0" transform="matrix(1,0,0,1,-25, 97)" class="text_joueur" style="font-size: 24px; font-family: Arial; text-anchor: start;"><?php echo $ad ?></text>
                                            </g>
                                        </g>

                                        <!-- Milieu Offensif -->
                                        <g id="g_j0" transform="matrix(1,0,0,1,700,340)" class="ad">
                                            <image height="70" left="0" preserveAspectRatio="none" top="0" width="70" x="0" y="0" xmlns:svg="http://www.w3.org/2000/svg" xlink:href="https://www.demivolee.com/wp-content/plugins/OutilCompoWordpress-2.7.0/assets/maillot/neutre.png"></image>
                                            <g  xmlns:svg="http://www.w3.org/2000/svg" class="dropzone draggable">
                                                <rect fill="#21316a" height="39" rx="10" ry="10" width="140" x="-35" y="69"></rect>
                                                <text  fill="#ffffff" id="j0" left="0" top="0" transform="matrix(1,0,0,1,-25, 97)" class="text_joueur" style="font-size: 24px; font-family: Arial; text-anchor: start;"><?php echo $moc ?></text>
                                            </g>   
                                        </g>

                                        <!-- Buteur -->
                                        <g id="g_j0" transform="matrix(1,0,0,1,900,340)" class="bu">
                                            <image height="70" left="0" preserveAspectRatio="none" top="0" width="70" x="0" y="0" xmlns:svg="http://www.w3.org/2000/svg" xlink:href="https://www.demivolee.com/wp-content/plugins/OutilCompoWordpress-2.7.0/assets/maillot/neutre.png"></image>
                                            <g  xmlns:svg="http://www.w3.org/2000/svg" class="dropzone draggable">
                                                <rect fill="#21316a" height="39" rx="10" ry="10" width="140" x="-35" y="69"></rect>
                                                <text  fill="#ffffff" id="j0" left="0" top="0" transform="matrix(1,0,0,1,-25, 97)" class="text_joueur" style="font-size: 24px; font-family: Arial; text-anchor: start;"><?php echo $bu ?></text>
                                            </g>
                                        </g>

                                    </g>
                                </svg>
                            </div>
                    </div>

                    <div class="container-droite">
                        <form action="<?php echo "feuillematch.php?id=" . $id ?>" method="post">

                            <div class="selection-joueur">

                                <h1>Joueurs titulaires</h1>
                                <hr>
                                <select class="select-joueur"name="gardien" id="gardien">
                                    <option value="Joueur 1" selected>Joueur 1</option>
                                    <?php
                                        //Affichage de la liste de tout les joueurs enregistrés dans la base de données
                                        while ($data = $reqGardien->fetch()) {
                                            if ($data['Poste'] == 'Gardien') {
                                                echo '<option value="' . $data['Nom'] . '">' . $data['Nom'] . '</option>';
                                            }
                                        }
                                    ?>
                                </select>
                                <select class="select-joueur" name="dd" id="dd">
                                    <option value="Joueur 2" selected>Joueur 2</option>
                                    <?php
                                        //Affichage de la liste de tout les joueurs enregistrés dans la base de données
                                        while ($data = $reqDD->fetch()) {
                                            if ($data['Poste'] == 'Défenseur') {
                                                echo '<option value="' . $data['Nom'] . '">' . $data['Nom'] . '</option>';
                                            }
                                        }
                                    ?>
                                </select>
                                <select class="select-joueur" name="dg" id="dg">
                                    <option value="Joueur 3" selected>Joueur 3</option>
                                    <?php
                                        //Affichage de la liste de tout les joueurs enregistrés dans la base de données
                                        while ($data = $reqDG->fetch()) {
                                            if ($data['Poste'] == 'Défenseur') {
                                                echo '<option value="' . $data['Nom'] . '">' . $data['Nom'] . '</option>';
                                            }
                                        }
                                    ?>
                                </select>
                                <select class="select-joueur" name="dcd" id="dcd">
                                    <option value="Joueur 4" selected>Joueur 4</option>
                                    <?php
                                        //Affichage de la liste de tout les joueurs enregistrés dans la base de données
                                        while ($data = $reqDCD->fetch()) {
                                            if ($data['Poste'] == 'Défenseur') {
                                                echo '<option value="' . $data['Nom'] . '">' . $data['Nom'] . '</option>';
                                            }
                                        }
                                    ?>
                                </select>
                                <select class="select-joueur" name="dcg" id="dcg">
                                    <option value="Joueur 5" selected>Joueur 5</option>
                                    <?php
                                        //Affichage de la liste de tout les joueurs enregistrés dans la base de données
                                        while ($data = $reqDCG->fetch()) {
                                            if ($data['Poste'] == 'Défenseur') {
                                                echo '<option value="' . $data['Nom'] . '">' . $data['Nom'] . '</option>';
                                            }
                                        }
                                    ?>
                                </select>
                                <select class="select-joueur" name="mdcd" id="mdcd">
                                    <option value="Joueur 6" selected>Joueur 6</option>
                                    <?php
                                        //Affichage de la liste de tout les joueurs enregistrés dans la base de données
                                        while ($data = $reqMDCD->fetch()) {
                                            if ($data['Poste'] == 'Milieu' and $data['Statut'] == 'Actif') {
                                                echo '<option value="' . $data['Nom'] . '">' . $data['Nom'] . '</option>';
                                            }
                                        }
                                    ?>
                                </select>
                                <select class="select-joueur" name="ad" id="ad">
                                    <option value="Joueur 7" selected>Joueur 7</option>
                                    <?php
                                        //Affichage de la liste de tout les joueurs enregistrés dans la base de données
                                        while ($data = $reqAD->fetch()) {
                                            if ($data['Poste'] == 'Attaquant') {
                                                echo '<option value="' . $data['Nom'] . '">' . $data['Nom'] . '</option>';
                                            }
                                        }
                                    ?>
                                </select>
                                <input type="submit" class="submit submit-feuille" name="valider" value="Valider">
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </main>
    </body>
</html>