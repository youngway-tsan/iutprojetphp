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
        $reqDDBIS = $sql->getJoueurs();
        $reqDG = $sql->getJoueurs();
        $reqDCD = $sql->getJoueurs();
        $reqDCG = $sql->getJoueurs();
        $reqMDCD = $sql->getJoueurs();
        $reqAD = $sql->getJoueurs();
        $reqMDCG = $sql->getJoueurs();
        $reqBU = $sql->getJoueurs();
        $reqMOC = $sql->getJoueurs();
        $reqAG = $sql->getJoueurs();

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
                    </div>

                    <div class="container-droite">
                        <form action="<?php echo "feuillematch.php?id=" . $id ?>" method="post">

                            <div class="selection-joueur">

                                <h1>Joueurs titulaires</h1>
                                <hr>
                                <select class="select-joueur"name="gardien" id="gardien">
                                    <option value="Joueur 1" selected><?php echo $gardien ?></option>
                                    <?php
                                        //Affichage de la liste de tout les joueurs enregistrés dans la base de données
                                        while ($data = $reqGardien->fetch()) {
                                            if ($data['Poste'] == 'Gardien' and $data['Statut'] == 'Actif') {
                                                echo '<option value="' . $data['Nom'] . '">' . $data['Prenom'] . ' ' . $data['Nom'] . '</option>';
                                            }
                                        }
                                    ?>
                                </select>
                                <select class="select-joueur" name="dd" id="dd">
                                    <option value="Joueur 2" selected><?php echo $dd ?></option>
                                    <?php
                                        //Affichage de la liste de tout les joueurs enregistrés dans la base de données
                                        while ($data = $reqDD->fetch()) {
                                            if ($data['Poste'] == 'Défenseur' and $data['Statut'] == 'Actif') {
                                                //Elimine du select les joueurs déjà choisit à un autre poste
                                                if ($dg != $data['Nom'] and $dcd !=$data['Nom'] and $dcg !=$data['Nom'])  {
                                                    echo '<option value="' . $data['Nom'] . '">' . $data['Prenom'] . ' ' . $data['Nom'] . '</option>';
                                                }
                                            }
                                        }
                                    ?>
                                </select>
                                <select class="select-joueur" name="dg" id="dg">
                                    <option value="Joueur 3" selected><?php echo $dg ?></option>
                                    <?php
                                        //Affichage de la liste de tout les joueurs enregistrés dans la base de données
                                        while ($data = $reqDG->fetch()) {
                                            if ($data['Poste'] == 'Défenseur' and $data['Statut'] == 'Actif') {
                                                echo '<option value="' . $data['Nom'] . '">' . $data['Prenom'] . ' ' . $data['Nom'] . '</option>';
                                            }
                                        }
                                    ?>
                                </select>
                                <select class="select-joueur" name="dcd" id="dcd">
                                    <option value="Joueur 4" selected><?php echo $dcd ?></option>
                                    <?php
                                        //Affichage de la liste de tout les joueurs enregistrés dans la base de données
                                        while ($data = $reqDCD->fetch()) {
                                            if ($data['Poste'] == 'Défenseur' and $data['Statut'] == 'Actif') {
                                                echo '<option value="' . $data['Nom'] . '">' . $data['Prenom'] . ' ' . $data['Nom'] . '</option>';
                                            }
                                        }
                                    ?>
                                </select>
                                <select class="select-joueur" name="dcg" id="dcg">
                                    <option value="Joueur 5" selected><?php echo $dcg ?></option>
                                    <?php
                                        //Affichage de la liste de tout les joueurs enregistrés dans la base de données
                                        while ($data = $reqDCG->fetch()) {
                                            if ($data['Poste'] == 'Défenseur' and $data['Statut'] == 'Actif') {
                                                echo '<option value="' . $data['Nom'] . '">' . $data['Prenom'] . ' ' . $data['Nom'] . '</option>';
                                            }
                                        }
                                    ?>
                                </select>
                                <select class="select-joueur" name="mdcd" id="mdcd">
                                    <option value="Joueur 6" selected><?php echo $mdcd ?></option>
                                    <?php
                                        //Affichage de la liste de tout les joueurs enregistrés dans la base de données
                                        while ($data = $reqMDCD->fetch()) {
                                            if ($data['Poste'] == 'Milieu' and $data['Statut'] == 'Actif') {
                                                echo '<option value="' . $data['Nom'] . '">' . $data['Prenom'] . ' ' . $data['Nom'] . '</option>';
                                            }
                                        }
                                    ?>
                                </select>
                                <select class="select-joueur" name="ad" id="ad">
                                    <option value="Joueur 7" selected><?php echo $ad ?></option>
                                    <?php
                                        //Affichage de la liste de tout les joueurs enregistrés dans la base de données
                                        while ($data = $reqAD->fetch()) {
                                            if ($data['Poste'] == 'Attaquant' and $data['Statut'] == 'Actif') {
                                                echo '<option value="' . $data['Nom'] . '">' . $data['Prenom'] . ' ' . $data['Nom'] . '</option>';
                                            }
                                        }
                                    ?>
                                </select>
                                <select class="select-joueur" name="mdcg" id="mdcg">
                                    <option value="Joueur 8" selected><?php echo $mdcg ?></option>
                                    <?php
                                        //Affichage de la liste de tout les joueurs enregistrés dans la base de données
                                        while ($data = $reqMDCG->fetch()) {
                                            if ($data['Poste'] == 'Milieu' and $data['Statut'] == 'Actif') {
                                                echo '<option value="' . $data['Nom'] . '">' . $data['Prenom'] . ' ' . $data['Nom'] . '</option>';
                                            }
                                        }
                                    ?>
                                </select>
                                <select class="select-joueur" name="bu" id="bu">
                                    <option value="Joueur 9" selected><?php echo $bu ?></option>
                                    <?php
                                        //Affichage de la liste de tout les joueurs enregistrés dans la base de données
                                        while ($data = $reqBU->fetch()) {
                                            if ($data['Poste'] == 'Attaquant' and $data['Statut'] == 'Actif') {
                                                echo '<option value="' . $data['Nom'] . '">' . $data['Prenom'] . ' ' . $data['Nom'] . '</option>';
                                            }
                                        }
                                    ?>
                                </select>
                                <select class="select-joueur" name="moc" id="moc">
                                    <option value="Joueur 10" selected><?php echo $moc ?></option>
                                    <?php
                                        //Affichage de la liste de tout les joueurs enregistrés dans la base de données
                                        while ($data = $reqMOC->fetch()) {
                                            if ($data['Poste'] == 'Milieu' and $data['Statut'] == 'Actif') {
                                                echo '<option value="' . $data['Nom'] . '">' . $data['Prenom'] . ' ' . $data['Nom'] . '</option>';
                                            }
                                        }
                                    ?>
                                </select>
                                <select class="select-joueur" name="ag" id="ag">
                                    <option value="Joueur 11" selected><?php echo $ag ?></option>
                                    <?php
                                        //Affichage de la liste de tout les joueurs enregistrés dans la base de données
                                        while ($data = $reqAG->fetch()) {
                                            if ($data['Poste'] == 'Attaquant' and $data['Statut'] == 'Actif') {
                                                echo '<option value="' . $data['Nom'] . '">' . $data['Prenom'] . ' ' . $data['Nom'] . '</option>';
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
        <!-- Script pour insérer les joueurs dans les balises text depuis les select dynamiquement -->
        <script>
            var select = document.getElementById("gardien");
            var text = document.getElementById("j1");

            var select2 = document.getElementById("dd");
            var text2 = document.getElementById("j2");

            var select3 = document.getElementById("dg");
            var text3 = document.getElementById("j3");

            var select4 = document.getElementById("dcd");
            var text4 = document.getElementById("j4");

            var select5 = document.getElementById("dcg");
            var text5 = document.getElementById("j5");

            var select6 = document.getElementById("mdcd");
            var text6 = document.getElementById("j6");

            var select7 = document.getElementById("ad");
            var text7 = document.getElementById("j7");

            var select8 = document.getElementById("mdcg");
            var text8 = document.getElementById("j8");

            var select9 = document.getElementById("bu");
            var text9 = document.getElementById("j9");

            var select10 = document.getElementById("moc");
            var text10 = document.getElementById("j10");

            var select11 = document.getElementById("ag");
            var text11 = document.getElementById("j11");
    
            select.addEventListener("change", function() {
                text.innerHTML = select.value;
            });

            select2.addEventListener("change", function() {
                text2.innerHTML = select2.value;
            });

            select3.addEventListener("change", function() {
                text3.innerHTML = select3.value;
            });

            select4.addEventListener("change", function() {
                text4.innerHTML = select4.value;
            });

            select5.addEventListener("change", function() {
                text5.innerHTML = select5.value;
            });

            select6.addEventListener("change", function() {
                text6.innerHTML = select6.value;
            });

            select7.addEventListener("change", function() {
                text7.innerHTML = select7.value;
            });

            select8.addEventListener("change", function() {
                text8.innerHTML = select8.value;
            });

            select9.addEventListener("change", function() {
                text9.innerHTML = select9.value;
            });

            select10.addEventListener("change", function() {
                text10.innerHTML = select10.value;
            });

            select11.addEventListener("change", function() {
                text11.innerHTML = select11.value;
            });
        </script>

        <script>
            var select12 = document.getElementById("dg");
            select12.addEventListener("change", function() {
                <?php
                    //Elimine du select du joueur 2 les joueurs déjà choisit à un autre poste
                    while ($data = $reqDDBIS->fetch()) {
                        if ($data['Poste'] == 'Défenseur' and $data['Statut'] == 'Actif' and $dg != $data['Nom']) {
                             echo '<option value="' . $data['Nom'] . '">' . $data['Prenom'] . ' ' . $data['Nom'] . '</option>';
                        }
                    }
                ?>
            });
        </script>
    </body>
</html>