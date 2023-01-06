<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Liste des matchs - F.C. WOIPPY</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="img/FCWoippy-logo.png">
    </head>

    <?php
        require_once("header.php");
        $header = new header();

        require_once("sql.php");
        $sql = new requeteSQL();

        $param = array();
        $param[0] = null;
        $param[1] = null;
        $param[2] = "default";
        if (isset($_POST['valider'])){
            $param[0] = $_POST['datetime-match'];
            $param[1] = $_POST['nom-team-adverse'];
            $param[2] = $_POST['lieu'];
        }

        $req = $sql -> getMatch($param);
    ?>

    <body>
        <main class="main-listes">
            <section class="main-listes-container">
                <h1>Liste des matchs du F.C WOIPPY</h1>
                <hr>
                <form action="" method="post">
                    <div class="filtre">
                        <input type="datetime-local" name="datetime-match" placeholder="Horaire du Match">
                        <input type="text" name="nom-team-adverse" placeholder="Nom Équipe Adverse">
                        <select name="lieu">
                            <option value="default">Lieu</option>
                            <option value="Domicile">Domicile</option>
                            <option value="Extérieur">Extérieur</option>
                        </select>
                        <input type="submit" class="submit" name="valider" value="Valider">
                    </div>
                </form>

                <table>
                    <tr>
                        <th>Match</th> 
                        <th>Date</th>
                        <th>Feuille de Match</th>
                        <th>Score</th>
                        <th>Évaluer Performance</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>
                    <?php
                        while ($donnees = $req -> fetch()){
                        echo '
                            <form action="" method="post">
                            <tr>';
                            if ($donnees[2] == "Domicile") {
                                echo'<td> F.C WOIPPY - '.$donnees[0].'</td>';
                            } else {
                                echo'<td>'.$donnees[0].'- F.C WOIPPY </td>';
                            }
                            echo'
                                <td>'.date('d/m/Y H:i:s', strtotime($donnees[1])).'</td>

                                <td>
                                    <label>
                                        <a href="feuillematch.php?id='.$donnees[3].'">
                                        <svg width="30px" height="30px" viewBox="-4 0 34 34" xmlns="http://www.w3.org/2000/svg">
                                            <g fill="none" fill-rule="evenodd">
                                                <g>
                                                    <path d="M1 1.993c0-.55.45-.993.995-.993h17.01c.55 0 1.34.275 1.776.625l3.44 2.75c.43.345.78 1.065.78 1.622v26.006c0 .55-.447.997-1 .997H2c-.552 0-1-.452-1-.993V1.993z" stroke="#474747" stroke-width="2"/>
                                                    <g fill="#575757">
                                                        <path d="M6 12h14v1H6z"/>
                                                        <path d="M6 15h14v1H6z"/>
                                                        <path d="M6 18h14v1H6z"/>
                                                        <path d="M6 21h6v1H6z"/>
                                                    </g>
                                                    <path fill="#474747" d="M18 2h1v6h-1z"/>
                                                    <path fill="#474747" d="M18 7h6v1h-6z"/>
                                                </g>
                                            </g>
                                        </svg>
                                        </a>
                                    </label>
                                </td>';

                                if ($donnees[4] != null) {
                                    echo'<td>'.$donnees[4].'</td>';    
                                } else {
                                    echo '
                                    <td>
                                        <label>
                                            <a href="rentrerscorematch.php?id='.$donnees[3].'">
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
                                    </td>';
                                } echo '
                                <td>'.'</td>
                                <td>
                                    <label>
                                        <a href="modificationmatch.php?id='.$donnees[3].'">
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