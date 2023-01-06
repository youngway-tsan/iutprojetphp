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
                <hr>
                <form action="" method="post">
                    
                </form>

                <table>
                    <?php
                        echo '
                        <td>'.$nomAdversaire.'</td>';
                        
                    ?>         
                </table>
            </section>
        </main>
    </body>
</html>