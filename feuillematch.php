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

                <svg  width="100%" height="100%" id="svg" viewBox="0 0 1150 820" xmlns="http://www.w3.org/2000/svg">

                    <image  height="1220" id="_field" width="1150" x="0" y="0" xlink:href="https://www.demivolee.com/wp-content/plugins/OutilCompoWordpress-2.7.0/assets/field/field_big.png"></image>
                    <image  height="790" id="_lines" width="1150" x="0" y="20" xlink:href="https://www.demivolee.com/wp-content/plugins/OutilCompoWordpress-2.7.0/assets/field/lines.png"></image>

                    <g _ngcontent-ljs-c23="" left="0" top="0" transform="matrix(1,0,0,1,0,20)" class="contents">
                        
        
                        <g _ngcontent-ljs-c23="" id="g_j0" transform="matrix(1,0,0,1,120,340)" app-goalkeeper-field="" class="gardien g_player" _nghost-ljs-c21="">
                            <image _ngcontent-ljs-c21="" height="70" left="0" preserveAspectRatio="none" top="0" width="70" x="0" y="0" xmlns:svg="http://www.w3.org/2000/svg" class="m_gardien dropzone" xlink:href="https://www.demivolee.com/wp-content/plugins/OutilCompoWordpress-2.7.0/assets/maillot/neutre.png" style="/* filter: none; */"></image>
                            <g _ngcontent-ljs-c21="" id="drag_j0" xmlns:svg="http://www.w3.org/2000/svg" class="dropzone draggable">
                                <rect _ngcontent-ljs-c21="" fill="#21316a" height="39" rx="10" ry="10" width="80" x="-5" y="69"></rect>
                                <text  fill="#ffffff" id="j0" left="0" top="0" transform="matrix(1,0,0,1,-7.5, 97)" class="text_joueur" style="font-size: 24px; font-family: Arial; text-anchor: start;"></text>
                             </g>
                        </g>

                        <g _ngcontent-ljs-c23="" id="g_j0" transform="matrix(1,0,0,1,300,100)" app-goalkeeper-field="" class="gardien g_player" _nghost-ljs-c21="">
                            <image _ngcontent-ljs-c21="" height="70" left="0" preserveAspectRatio="none" top="0" width="70" x="0" y="0" xmlns:svg="http://www.w3.org/2000/svg" class="m_gardien dropzone" xlink:href="https://www.demivolee.com/wp-content/plugins/OutilCompoWordpress-2.7.0/assets/maillot/neutre.png" style="/* filter: none; */"></image>
                            <g _ngcontent-ljs-c21="" id="drag_j0" xmlns:svg="http://www.w3.org/2000/svg" class="dropzone draggable">
                                <rect _ngcontent-ljs-c21="" fill="#21316a" height="39" rx="10" ry="10" width="80" x="-5" y="69"></rect>
                                <text  fill="#ffffff" id="j0" left="0" top="0" transform="matrix(1,0,0,1,-7.5, 97)" class="text_joueur" style="font-size: 24px; font-family: Arial; text-anchor: start;"></text>
                             </g>
                        </g>

                        <g _ngcontent-ljs-c23="" id="g_j0" transform="matrix(1,0,0,1,300,100)" app-goalkeeper-field="" class="gardien g_player" _nghost-ljs-c21="">
                            <image _ngcontent-ljs-c21="" height="70" left="0" preserveAspectRatio="none" top="0" width="70" x="0" y="0" xmlns:svg="http://www.w3.org/2000/svg" class="m_gardien dropzone" xlink:href="https://www.demivolee.com/wp-content/plugins/OutilCompoWordpress-2.7.0/assets/maillot/neutre.png" style="/* filter: none; */"></image>
                            <g _ngcontent-ljs-c21="" id="drag_j0" xmlns:svg="http://www.w3.org/2000/svg" class="dropzone draggable">
                                <rect _ngcontent-ljs-c21="" fill="#21316a" height="39" rx="10" ry="10" width="80" x="-5" y="69"></rect>
                                <text  fill="#ffffff" id="j0" left="0" top="0" transform="matrix(1,0,0,1,-7.5, 97)" class="text_joueur" style="font-size: 24px; font-family: Arial; text-anchor: start;"></text>
                             </g>
                        </g>


                    </g>

                </svg>


            </section>
        </main>
    </body>
</html>