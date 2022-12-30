<!DOCTYPE html>
<html>
    <head>
        <meta charset ="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Liste Joueur - F.C. WOIPPY</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="img/FCWoippy-logo.png">
    </head>
    <body>
        <?php
        require_once('sql.php');
        require_once('header.php');
        $header = new header();
        $sql = new requeteSQL();

        $param = array();
        $param[0] = null;
        $param[1] = null;
        $param[2] = "default";
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
                        <input type="submit" class="submit" name="valider" value="Valider">
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
                    <?php
                        while ($donnees = $req -> fetch()){
                        echo '
                            <form action="" method="post">
                            <tr>
                                <td>'.$donnees[0].'</td>
                                <td>'.$donnees[1].'</td>
                                <td>'.$donnees[2].'</td>
                                <td>'.$donnees[3].'</td>

                                <td>
                                    <input type="hidden" name="id" value='.$donnees[4].'>
                                    <label>
                                        <a href="modificationjoueur.php?licence='.$donnees[4].'">
                                        <svg class="svgmodifier"fill="#000000" height="20px" width="20px" version="1.1" id="XMLID_278_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24" xml:space="preserve">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <g id="edit"> 
                                                <path d="M6.5,24H0v-6.5L17.5,0L24,6.5L6.5,24z M2,22h3.7L18,9.7L14.3,6L2,18.3V22z M15.7,4.6l3.7,3.7l1.8-1.8l-3.7-3.7L15.7,4.6z">
                                                </path> 
                                                    </g> 
                                                </g>
                                            </g>
                                        </svg>
                                        </a>
                                    </label>
                                </td>

                                <td>
                                    <input type="hidden" name="id" value ='.$donnees[4].'>
                                    <input type="submit" class ="submit supprimer" name="supprimer" value="Supprimer">
                                </td>
                            </tr>
                            </form>
                            ';
                        }
                    ?>
                </table>
            </section>
        </main>
    </body>
</html>