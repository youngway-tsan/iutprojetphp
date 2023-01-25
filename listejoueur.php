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

        session_start();
        if ($_SESSION["connected"] != True){
            header('Location: index.php');
        }
        
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

        //Traitement statut 
        if (isset($_POST['submit-ok'])){
            $sql->modifierStatut($_POST['hidden-licence'],$_POST['select-statut']);
            header('Location: listejoueur.php');
        }

        //Traitement popup supprimer joueur
        if (isset($_GET['idJoueurSupprimer'])) {
            $licence = $_GET['idJoueurSupprimer'];
            $sql -> supprimerJoueur($licence);
            header('Location: listejoueur.php');
        }

        //Traitement popup commentaire
        if (isset($_POST['popupconfirmer'])) {
            $licence = $_POST['idJoueurCommentaire'];
            $commentaire = $_POST['commentaire'];
            $sql -> addCommentaire($licence, $commentaire);
            header('Location: listejoueur.php');
        }
        ?>

        <main class="main-listes">

            <div class="popup popup-supprimer">
                <div class="popup-content">
                    <div class="popup-header">
                        <h2>Confirmation</h2>
                    </div>
                    <div class="popup-body">
                        <span>
                            Voulez-vous vraiment supprimer ce joueur ?
                            <br>
                            (Notez qu'il sera impossible de le supprimer s'il est déjà inscrit à un match)
                        </span>
                        <hr>
                        <div class="popup-button">
                            <input type="button" class="submit button-non" name="popupnon" value="Non" onclick='popUpNon()'>
                            <input type="button" class="submit button-oui" name="popupoui" value="Oui" onclick='popUpOui()'>
                        </div>
                    </div>
                </div>
            </div>

            <div class="popup popup-commentaire">
                <div class="popup-content">
                    <div class="popup-header">
                        <h2>Ajouter un commentaire</h2>
                    </div>
                    <div class="popup-body">
                        <form action="" method="post">
                            <input type="text" name="commentaire" maxlength="50"> 
                            <hr>
                            <div class="popup-button">
                                <input type="hidden" name="idJoueurCommentaire" id="idJoueurCommentaire">
                                <input type="submit" class="submit button-non" name="popupannuler" value="Annuler" onclick="popUpAnnuler()">
                                <input type="submit" class="submit button-oui" name="popupconfirmer" value="Confirmer" onclick="popUpConfirmer()">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

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
                            <th></th>
                            <th>Statut</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                        </tr>
                        <?php
                            $option_statut = ["Actif", "Blessé", "Suspendu", "Absent"];
                            while ($donnees = $req -> fetch()){
                            $id_joueur = $donnees[4];
                            echo '
                                <form action="" method="post">
                                <tr>
                                    <td>'.$donnees[0].'</td> 
                                    <td>'.$donnees[1].'</td>
                                    <td>'.$donnees[2].'</td>
                                    <td>
                                        <label>
                                            <a data-idjoueur = '.$id_joueur.' onclick="setIdJoueur(this.dataset.idjoueur) ; showPopUpCommentaire() ">
                                            <svg class="svgLink" fill="#000000" width="20px" height="20px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><path d="M 3 5 L 3 23 L 8 23 L 8 28.078125 L 14.351563 23 L 29 23 L 29 5 Z M 5 7 L 27 7 L 27 21 L 13.648438 21 L 10 23.917969 L 10 21 L 5 21 Z M 10 12 C 8.894531 12 8 12.894531 8 14 C 8 15.105469 8.894531 16 10 16 C 11.105469 16 12 15.105469 12 14 C 12 12.894531 11.105469 12 10 12 Z M 16 12 C 14.894531 12 14 12.894531 14 14 C 14 15.105469 14.894531 16 16 16 C 17.105469 16 18 15.105469 18 14 C 18 12.894531 17.105469 12 16 12 Z M 22 12 C 20.894531 12 20 12.894531 20 14 C 20 15.105469 20.894531 16 22 16 C 23.105469 16 24 15.105469 24 14 C 24 12.894531 23.105469 12 22 12 Z"/></svg>
                                            </a>
                                        </label>
                                    </td>
                                    <td>
                                        <select class="statut" name="select-statut" id="select-statut">
                                            ';
                                            foreach ($option_statut as $statut_actuel) {
                                                if ($statut_actuel == $donnees[3]){
                                                    echo '
                                                        <option selected>'.$statut_actuel.'</option>
                                                    ';
                                                } else {
                                    echo '
                                                        <option>' . $statut_actuel . '</option>
                                                    ';
                                                }
                                            }
                                    echo '
                                        </select>
                                        <input type="hidden" name="hidden-licence" value="'.$id_joueur.'">
                                        <input type="submit" class="submit-ok submit" name="submit-ok" value="ok">
                                    </td>
                                    <td>
                                        <label>
                                            <a href="modificationjoueur.php?licence='.$donnees[4].'">
                                            <svg class="svgLink"fill="#000000" height="20px" width="20px" version="1.1" id="XMLID_278_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24" xml:space="preserve">
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
                                        <input type="button" class ="submit supprimer" name="supprimer" value="Supprimer" data-idjoueur ='.$id_joueur.'  onclick="setIdJoueur(this.dataset.idjoueur) ; showPopupSupprimer()">
                                    </td>
                                </tr>
                                </form>
                                ';
                            }
                        ?>
                    </table>
            </section>
        </main>

        <script>
            let idJoueur;

            function setIdJoueur(id){
                idJoueur = id;
            }

            function showPopupSupprimer(){
                document.querySelector('.popup-supprimer').style.display = 'flex';
            }

            function popUpNon(){
                document.querySelector('.popup-supprimer').style.display = 'none';
            }

            function popUpOui(){
                document.querySelector('.popup-supprimer').style.display = 'none';
                window.location.href="listejoueur.php?idJoueurSupprimer=" + idJoueur;
                //Supprimer la photo du joueur
                unlink($donnees[5]);
            }

            function showPopUpCommentaire(){
                document.getElementById("idJoueurCommentaire").value = idJoueur;
                document.querySelector('.popup-commentaire').style.display = 'flex';
            }

            function popUpAnnuler(){
                document.querySelector('.popup-commentaire').style.display = 'none';
            }
            
            function popUpConfirmer(){
                document.querySelector('.popup-commentaire').style.display = 'none';
            }

        </script>

    </body>
</html>