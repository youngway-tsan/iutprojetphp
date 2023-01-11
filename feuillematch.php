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

        //Initialisation de variables
        if (empty($_POST['gardien'])) {
            $gardien = "Joueur 1";
        } else {
            $gardien = $_POST['gardien'];
        }

        $dg = "Joueur 3";
        $dcg = "Joueur 5";
        $dcd = "Joueur 4";

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
                <form action="<?php echo "feuillematch.php?id=" . $id ?>" method="post">
                    <h1>Feuille de match : <?php echo $nomAdversaire ?> [<?php echo $lieu ?>]</h1>
                    </br>
                    <div class="filtre">
                        <select name="gardien" id="gardien">
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
                        <select name="dd" id="dd">
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
                        <input type="submit" class="submit" name="valider" value="Valider">
                    </div>
                </form>

                </br>
                <!-- Composition -->
                <svg  width="100%" height="100%" id="svg" viewBox="0 0 1150 820" xmlns="http://www.w3.org/2000/svg">
                    <image  height="1220" id="field" width="1150" x="0" y="0" xlink:href="https://www.demivolee.com/wp-content/plugins/OutilCompoWordpress-2.7.0/assets/field/field_big.png"></image>
                    <image  height="790" id="lines" width="1150" x="0" y="20" xlink:href="https://www.demivolee.com/wp-content/plugins/OutilCompoWordpress-2.7.0/assets/field/lines.png"></image>
                    
                    <!-- Poste -->
                    <g _ngcontent-ljs-c23="" left="0" top="0" transform="matrix(1,0,0,1,0,20)" class="contents">
                    
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

            </section>
        </main>
    </body>
</html>