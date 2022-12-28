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

        $param = array();
        if (isset($_POST['valider'])){
            $param[0] = $_POST['nom'];
            $param[1] = $_POST['prenom'];
            $param[2] = $_POST['poste'];
        }
        $req = $sql -> getJoueur($param);
        ?>

        <main class="main-listes">
            <section class="main-listes-container">
                <h1>Liste des joueurs du F.C WOIPPY</h1>
                <hr>
                <form action="" method="post">
                    <div class="filtre">
                        <input type="text" name="nom" placeholder="Nom">
                        <input type="text" name="prenom" placeholder="Prénom">
                        <select name="poste">
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
                        <th></th>
                        <th>Statut</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>
                    <?php
                        while ($donnees = $req -> fetch()){
                        echo '
                            <tr>
                                <td>'.$donnees[0].'</td>
                                <td>'.$donnees[1].'</td>
                                <td>'.$donnees[2].'</td>
                                <td><input type="button" value="Modifier commentaire" class="button commentaire onclick="""></td>
                                <td>'.$donnees[3].'</td>
                                <td>
                                    <form action="" method="post">
                                    <input type="hidden" name="id" value='.$donnees[4].'>
                                    <input type="submit" class="submit modifier" name="modifier" value="Modifier">
                                    </form>
                                </td>
                                <td>
                                    <form action="" method="post">
                                    <input type="hidden" name="id" value ='.$donnees[4].'>
                                    <input type="submit" class ="submit supprimer" name="supprimer" value="Supprimer">
                                    </form>
                                </td>
                            </tr>
                            ';
                        }
                    ?>
                </table>
            </section>
        </main>
    </body>
</html>