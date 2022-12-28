<!DOCTYPE html>
<html>
    <head>
        <meta charset ="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Liste Joueur - F.C. WOIPPY</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <?php
        require_once('sql.php');
        require_once('header.php');
        $header = new header();
        $sql = new requeteSQL();

        $sql->getJoueur();
        ?>

        <main class="main-listes">
            <section class="main-listes-container">
                <h1>Liste des joueurs du F.C WOIPPY</h1>
                <hr>
                <form action="" method="post">
                    <div class="filtre">
                        <input type="text" name="nom" placeholder="Nom">
                        <input type="text" name="prenom" placeholder="Prénom">
                        <select name="Poste">
                            <option value="default">Poste</option>
                            <option value="Gardien">Gardien</option>
                            <option value="Defenseur">Défenseur</option>
                            <option value="Milieu">Milieu</option>
                            <option value="Attaquant">Attaquant</option>
                        </select>
                        <input type="submit" class="submit" name="Valider">
                    </div>
                </form>

                <table>
                    <tr>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Commentaire</th>
                        <th>Statut</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>
                    
                </table>
                <?php
                        while($donnees = $sql -> fetch()){
                            echo $donnees[0];
                        }
                    ?>
            </section>
        </main>
    </body>
</html>