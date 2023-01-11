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

        $gardien = "Tchouaméni";


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
                <h1>Feuille de match : <?php echo $nomAdversaire ?> [<?php echo $lieu ?>] </h1>
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
                                <rect fill="#21316a" height="39" rx="10" ry="10" width="80" x="-5" y="69"></rect>
                                <text  fill="#ffffff" id="j0" left="0" top="0" transform="matrix(1,0,0,1,-7.5, 97)" class="text_joueur" style="font-size: 24px; font-family: Arial; text-anchor: start;"></text>
                             </g>
                        </g>

                        <!-- Défenseur Gauche -->
                        <g transform="matrix(1,0,0,1,300,100)" class="dg">
                            <image height="70" left="0" preserveAspectRatio="none" top="0" width="70" x="0" y="0" xmlns:svg="http://www.w3.org/2000/svg" xlink:href="https://www.demivolee.com/wp-content/plugins/OutilCompoWordpress-2.7.0/assets/maillot/neutre.png"></image>
                            <g  xmlns:svg="http://www.w3.org/2000/svg" class="dropzone draggable">
                                <rect fill="#21316a" height="39" rx="10" ry="10" width="80" x="-5" y="69"></rect>
                                <text  fill="#ffffff" id="j0" left="0" top="0" transform="matrix(1,0,0,1,-7.5, 97)" class="text_joueur" style="font-size: 24px; font-family: Arial; text-anchor: start;"></text>
                            </g>
                        </g>

                        <!-- Défenseur Centrale Gauche -->
                        <g id="g_j0" transform="matrix(1,0,0,1,300,260)" class="dcg">
                            <image height="70" left="0" preserveAspectRatio="none" top="0" width="70" x="0" y="0" xmlns:svg="http://www.w3.org/2000/svg" xlink:href="https://www.demivolee.com/wp-content/plugins/OutilCompoWordpress-2.7.0/assets/maillot/neutre.png"></image>
                            <g  xmlns:svg="http://www.w3.org/2000/svg" class="dropzone draggable">
                                <rect fill="#21316a" height="39" rx="10" ry="10" width="80" x="-5" y="69"></rect>
                                <text  fill="#ffffff" id="j0" left="0" top="0" transform="matrix(1,0,0,1,-7.5, 97)" class="text_joueur" style="font-size: 24px; font-family: Arial; text-anchor: start;"></text>
                            </g>
                        </g>

                        <!-- Défenseur Centrale Droit -->
                        <g id="g_j0" transform="matrix(1,0,0,1,300,420)" class="dcd">
                            <image height="70" left="0" preserveAspectRatio="none" top="0" width="70" x="0" y="0" xmlns:svg="http://www.w3.org/2000/svg" xlink:href="https://www.demivolee.com/wp-content/plugins/OutilCompoWordpress-2.7.0/assets/maillot/neutre.png"></image>
                            <g  xmlns:svg="http://www.w3.org/2000/svg" class="dropzone draggable">
                                <rect fill="#21316a" height="39" rx="10" ry="10" width="80" x="-5" y="69"></rect>
                                <text  fill="#ffffff" id="j0" left="0" top="0" transform="matrix(1,0,0,1,-7.5, 97)" class="text_joueur" style="font-size: 24px; font-family: Arial; text-anchor: start;"></text>
                            </g>
                        </g>

                        <!-- Défenseur Droit -->
                        <g id="g_j0" transform="matrix(1,0,0,1,300,580)" class="dd">
                            <image height="70" left="0" preserveAspectRatio="none" top="0" width="70" x="0" y="0" xmlns:svg="http://www.w3.org/2000/svg" xlink:href="https://www.demivolee.com/wp-content/plugins/OutilCompoWordpress-2.7.0/assets/maillot/neutre.png"></image>
                            <g  xmlns:svg="http://www.w3.org/2000/svg" class="dropzone draggable">
                                <rect fill="#21316a" height="39" rx="10" ry="10" width="80" x="-5" y="69"></rect>
                                <text  fill="#ffffff" id="j0" left="0" top="0" transform="matrix(1,0,0,1,-7.5, 97)" class="text_joueur" style="font-size: 24px; font-family: Arial; text-anchor: start;"></text>
                            </g>
                        </g>

                         <!-- Milieu Défensif Gauche -->
                        <g id="g_j0" transform="matrix(1,0,0,1,540,175)" class="mdcg">
                            <image height="70" left="0" preserveAspectRatio="none" top="0" width="70" x="0" y="0" xmlns:svg="http://www.w3.org/2000/svg" xlink:href="https://www.demivolee.com/wp-content/plugins/OutilCompoWordpress-2.7.0/assets/maillot/neutre.png"></image>
                            <g  xmlns:svg="http://www.w3.org/2000/svg" class="dropzone draggable">
                                <rect fill="#21316a" height="39" rx="10" ry="10" width="80" x="-5" y="69"></rect>
                                <text  fill="#ffffff" id="j0" left="0" top="0" transform="matrix(1,0,0,1,-7.5, 97)" class="text_joueur" style="font-size: 24px; font-family: Arial; text-anchor: start;"></text>
                            </g>
                        </g>

                        <!-- Milieu Défensif Droit -->
                        <g id="g_j0" transform="matrix(1,0,0,1,540,500)" class="mdcd">
                            <image height="70" left="0" preserveAspectRatio="none" top="0" width="70" x="0" y="0" xmlns:svg="http://www.w3.org/2000/svg" xlink:href="https://www.demivolee.com/wp-content/plugins/OutilCompoWordpress-2.7.0/assets/maillot/neutre.png"></image>
                            <g  xmlns:svg="http://www.w3.org/2000/svg" class="dropzone draggable">
                                <rect fill="#21316a" height="39" rx="10" ry="10" width="80" x="-5" y="69"></rect>
                                <text  fill="#ffffff" id="j0" left="0" top="0" transform="matrix(1,0,0,1,-7.5, 97)" class="text_joueur" style="font-size: 24px; font-family: Arial; text-anchor: start;"></text>
                            </g>
                        </g>

                        <!-- Milieu Offensif -->
                        <g id="g_j0" transform="matrix(1,0,0,1,800,100)" class="moc">
                            <image height="70" left="0" preserveAspectRatio="none" top="0" width="70" x="0" y="0" xmlns:svg="http://www.w3.org/2000/svg" xlink:href="https://www.demivolee.com/wp-content/plugins/OutilCompoWordpress-2.7.0/assets/maillot/neutre.png"></image>
                            <g  xmlns:svg="http://www.w3.org/2000/svg" class="dropzone draggable">
                                <rect fill="#21316a" height="39" rx="10" ry="10" width="80" x="-5" y="69"></rect>
                                <text  fill="#ffffff" id="j0" left="0" top="0" transform="matrix(1,0,0,1,-7.5, 97)" class="text_joueur" style="font-size: 24px; font-family: Arial; text-anchor: start;"></text>
                            </g>
                        </g>

                        <!-- Attaquant Gauche -->
                        <g id="g_j0" transform="matrix(1,0,0,1,800,580)" class="ag">
                            <image height="70" left="0" preserveAspectRatio="none" top="0" width="70" x="0" y="0" xmlns:svg="http://www.w3.org/2000/svg" xlink:href="https://www.demivolee.com/wp-content/plugins/OutilCompoWordpress-2.7.0/assets/maillot/neutre.png"></image>
                            <g  xmlns:svg="http://www.w3.org/2000/svg" class="dropzone draggable">
                                <rect fill="#21316a" height="39" rx="10" ry="10" width="80" x="-5" y="69"></rect>
                                <text  fill="#ffffff" id="j0" left="0" top="0" transform="matrix(1,0,0,1,-7.5, 97)" class="text_joueur" style="font-size: 24px; font-family: Arial; text-anchor: start;"></text>
                            </g>
                        </g>

                        <!-- Attaquant Droit -->
                        <g id="g_j0" transform="matrix(1,0,0,1,700,340)" class="ad">
                            <image height="70" left="0" preserveAspectRatio="none" top="0" width="70" x="0" y="0" xmlns:svg="http://www.w3.org/2000/svg" xlink:href="https://www.demivolee.com/wp-content/plugins/OutilCompoWordpress-2.7.0/assets/maillot/neutre.png"></image>
                            <g  xmlns:svg="http://www.w3.org/2000/svg" class="dropzone draggable">
                                <rect fill="#21316a" height="39" rx="10" ry="10" width="80" x="-5" y="69"></rect>
                                <text  fill="#ffffff" id="j0" left="0" top="0" transform="matrix(1,0,0,1,-7.5, 97)" class="text_joueur" style="font-size: 24px; font-family: Arial; text-anchor: start;"></text>
                            </g>   
                        </g>

                        <!-- Buteur -->
                        <g id="g_j0" transform="matrix(1,0,0,1,900,340)" class="bu">
                            <image height="70" left="0" preserveAspectRatio="none" top="0" width="70" x="0" y="0" xmlns:svg="http://www.w3.org/2000/svg" xlink:href="https://www.demivolee.com/wp-content/plugins/OutilCompoWordpress-2.7.0/assets/maillot/neutre.png"></image>
                            <g  xmlns:svg="http://www.w3.org/2000/svg" class="dropzone draggable">
                                <rect fill="#21316a" height="39" rx="10" ry="10" width="80" x="-5" y="69"></rect>
                                <text  fill="#ffffff" id="j0" left="0" top="0" transform="matrix(1,0,0,1,-7.5, 97)" class="text_joueur" style="font-size: 24px; font-family: Arial; text-anchor: start;"></text>
                            </g>
                        </g>

                    </g>
                </svg>


            </section>
        </main>
    </body>
</html>