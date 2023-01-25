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

        session_start();
        if ($_SESSION["connected"] != True){
            header('Location: index.php');
        }
        
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

        //Traitement popup supprimer match
        if (isset($_GET['idRencontreSupprimer'])) {
            $id_rencontre = $_GET['idRencontreSupprimer'];
            $sql -> supprimerRencontre($id_rencontre);
            header('Location: listematch.php');
        }

        $req = $sql -> getMatch($param);
    ?>

    <body>
        <main class="main-listes">

        <div class="popup popup-supprimer">
                <div class="popup-content">
                    <div class="popup-header">
                        <h2>Confirmation</h2>
                    </div>
                    <div class="popup-body">
                        <span>
                            Voulez-vous vraiment supprimer ce match ?
                        </span>
                        <hr>
                        <div class="popup-button">
                            <input type="button" class="button-non" name="popupnon" value="Non" onclick='popUpNon()'>
                            <input type="button" class="button-oui" name="popupoui" value="Oui" onclick='popUpOui()'>
                        </div>
                    </div>
                </div>
            </div>

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
                            //Match
                            if ($donnees[2] == "Domicile") {
                                echo'<td> F.C WOIPPY - '.$donnees[0].'</td>';
                            } else {
                                echo'<td>'.$donnees[0].'- F.C WOIPPY </td>';
                            }
                            //Date
                            echo'
                                <td>'.date('d/m/Y H:i:s', strtotime($donnees[1])).'</td>';

                                //FeuilleMatch
                                if ($sql -> feuilleMatchRempli($donnees[3])) {
                                    echo '
                                    <td>
                                        <label>
                                            <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">

                                                <g id="SVGRepo_bgCarrier" stroke-width="0"/>

                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>

                                                <g id="SVGRepo_iconCarrier"> <path d="M19.5 7L9 17.5L5 13.5" stroke="#46ef25" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/> </g>

                                            </svg>
                                        </label>
                                    </td>';
                                    
                                } else {
                                    echo '
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
                                }
                                

                                //On vérifie si la feuille de match est remplir
                                if ($sql -> feuilleMatchRempli($donnees[3])) {

                                    //Si la feuille de match est remplie et que la date correspond a un jour apres le match, alors l'entraineur a acces pour rentrer le score et evaluer les joueurs qui étaient sur la feuille de match
                                    if ((strtotime($donnees[1])) < strtotime(date("Y-m-d H:i:s") . ' - 3 hours')) {   

                                        //Rentrer Score
                                        if ($donnees[4] != null) {
                                            echo'<td>'.$donnees[4].'</td>';    
                                        } else {
                                            echo '
                                            <td>
                                                <label>
                                                    <a href="rentrerscorematch.php?id='.$donnees[3].'">
                                                    <svg height="25px" width="25px" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512"  xml:space="preserve">
                                                        <style type="text/css">
                                                            .st0{fill:#000000;}
                                                        </style>
                                                        <g>
                                                            <path class="st0" d="M367.918,69.237H129.781h-9.365l-7.227,5.949L9.514,160.546L0,168.382v12.322v79.167v21.874l21.534,3.824
                                                                l106.199,18.9c11.706,2.082,21.551,9.824,26.335,20.71l0.425,0.96l0.498,0.927c0.008,0.016,3.059,5.753,5.119,11.676
                                                                c21.993,63.19,76.312,104.023,138.385,104.023c44.031,0,84.652-19.019,111.437-52.186l67.359-84.359l0.624-0.782l0.566-0.832
                                                                l0.212-0.314l11.119-14.616l0.867-1.139l0.74-1.232C504.884,264.867,512,239.289,512,213.319
                                                                C512,133.872,447.365,69.237,367.918,69.237z M403.516,356.781l-13.894,17.395c-21.627,26.778-54.021,42.482-91.127,42.482
                                                                c-54.255,0-96.72-37.63-113.728-86.501c-2.821-8.106-6.798-15.483-6.798-15.483c-8.277-18.84-25.404-32.309-45.664-35.912
                                                                L26.106,259.87v-70.397H247.06c17.404,0,35.135,0,54.876,0c31.655,0,60.233,12.807,80.989,33.55
                                                                c20.739,20.752,33.541,49.331,33.546,80.986C416.466,323.078,411.738,340.975,403.516,356.781z M469.034,273.867l-11.726,15.415
                                                                l-0.417,0.646l-24.109,30.193c0.646-5.294,1.092-10.648,1.092-16.112c-0.004-72.87-59.065-131.931-131.938-131.94
                                                                c-19.741,0-37.472,0-54.876,0H36.592l93.188-76.727c0,0,202.62,0,238.137,0c65.158,0,117.976,52.823,117.976,117.977
                                                                C485.894,235.49,479.67,256.149,469.034,273.867z"/>
                                                            <polygon class="st0" points="240.836,154.853 315.673,154.853 369.809,109.466 294.972,109.466 	"/>
                                                        </g>
                                                    </svg>
                                                    </a>
                                                </label>
                                            </td>';
                                        }

                                        //Evaluer Performance
                                        echo 
                                        '<td>
                                            <label>
                                                <a href="evaluerperformance.php?id='.$donnees[3].'">
                                                <svg fill="#000000" width="25px" height="25px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1.537,9.488a1,1,0,0,0,.326,1.041l4.805,3.963-1.515,6.79a1,1,0,0,0,1.56,1.03L12,18.509l5.287,3.8a1,1,0,0,0,1.56-1.03l-1.515-6.79,4.805-3.963a1,1,0,0,0-.492-1.761l-5.817-.849L12.9,2.053a1.042,1.042,0,0,0-1.79,0L8.172,7.919l-5.817.849A1,1,0,0,0,1.537,9.488Zm7.441.335a1,1,0,0,0,.75-.542L12,4.736l2.272,4.545a1,1,0,0,0,.75.542l4.1.6L15.586,13.34a1,1,0,0,0-.339.989l1.076,4.826-3.739-2.69a1,1,0,0,0-1.168,0l-3.739,2.69,1.076-4.826a1,1,0,0,0-.339-.989L4.876,10.421Z"/>
                                                </svg>
                                            </label>
                                        </td>';

                                    } else {
 
                                        //Rentrer Score
                                        echo '
                                        <td>
                                            <label>
                                                <svg width="25px" height="25px" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--fxemoji" preserveAspectRatio="xMidYMid meet">
                                                    <path fill="#F9E7C0" d="M327.7 173.372c-20.641 20.641-45.275 47.46-48.299 82.362c3.024 34.902 27.659 61.721 48.299 82.362c27.953 24.088 45.652 59.747 45.652 99.542c0 .07-.005.139-.006.209h.006v56.025H110.648v-56.025h.006c0-.07-.006-.139-.006-.209c0-39.795 17.699-75.454 45.652-99.542c20.641-20.641 45.275-47.46 48.299-82.362c-3.024-34.902-27.659-61.721-48.299-82.362c-27.953-24.088-45.652-59.747-45.652-99.542V16.962h262.704V73.83c0 39.795-17.699 75.454-45.652 99.542z"></path>
                                                    <path fill="#FFB636" d="M242 427.504c9.777 0 59.476 54.092 59.476 54.092H182.524s49.699-54.092 59.476-54.092zm-5.25-71.823a5.906 5.906 0 1 0 0 11.811a5.906 5.906 0 0 0 0-11.811zm5.906 20.999a5.906 5.906 0 1 0 0 11.811a5.906 5.906 0 0 0 0-11.811zm-14.31 35.251a5.906 5.906 0 1 0 0 11.811a5.906 5.906 0 0 0 0-11.811zm17.56-83.169a5.906 5.906 0 1 0 0 11.811a5.906 5.906 0 0 0 0-11.811zM144.252 118.927c0 24.516 27.73 46.485 44.951 61.325c12.716 12.716 34.457 36.779 34.457 66.987c0 1.012.048 1.981.127 2.921c.639 24.677 3.799 52.197 11.638 62.017a5.906 5.906 0 1 0 10.373 2.621c10.525-6.473 14.175-40.104 14.515-69.728c1.8-25.503 22.332-52.666 34.484-64.818c17.221-14.84 44.951-36.808 44.951-61.325c0-11.927-195.496-11.927-195.496 0zm104.534 281.752a5.906 5.906 0 1 0 0 11.811a5.906 5.906 0 0 0 0-11.811z"></path>
                                                    <path fill="#68442A" d="M373.353 31.627H110.648c-8.1 0-14.666-6.566-14.666-14.666s6.566-14.666 14.666-14.666h262.705c8.1 0 14.666 6.566 14.666 14.666s-6.567 14.666-14.666 14.666zm14.666 462.245c0-8.1-6.566-14.665-14.666-14.665H110.648c-8.1 0-14.666 6.565-14.666 14.665s6.566 14.665 14.666 14.665h262.705c8.099 0 14.666-6.565 14.666-14.665z"></path>
                                                    <path fill="#FFD469" d="M339.748 115.432c0 9.076-43.763 16.434-97.748 16.434s-97.748-7.358-97.748-16.434S188.015 98.998 242 98.998s97.748 7.358 97.748 16.434z"></path>
                                                </svg>
                                            </label>
                                        </td>';

                                        //Evaluer Performance
                                        $timeDiff = strtotime($donnees[1]) - strtotime(date("Y-m-d H:i:s"));
                                        //Si moins d'un jour afficher les heures
                                        if ((floor($timeDiff / 3600)) > 24) {
                                            echo '<td> Encore : '. floor($timeDiff / 86400) . ' jours</td>';
                                        //Si moins d'une heure afficher les minutes
                                        } elseif((floor($timeDiff / 60)) > 60) {
                                            echo '<td> Encore : '. floor($timeDiff / 3600) . ' heures</td>';
                                        } else {
                                            echo '<td> Encore : '. floor($timeDiff / 60) . ' minutes</td>';
                                        }
                                        
                                    }

                                } else {
                                
                                    //Evaluer Performance
                                    echo '<td>'.'</td>';

                                    //Evaluer Performance
                                    echo '<td>'.'</td>';
                                }



                                //ModificationMatch
                                if ($sql -> feuilleMatchRempli($donnees[3])) {
                                    echo '
                                    <td>
                                        <label>
                                            <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">

                                                <g id="SVGRepo_bgCarrier" stroke-width="0"/>

                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>

                                                <g id="SVGRepo_iconCarrier"> <path d="M19.5 7L9 17.5L5 13.5" stroke="#46ef25" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/> </g>

                                            </svg>
                                        </label>
                                    </td>';   
                                } else {
                                    echo '
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
                                    </td>';
                                }



                                //Supprimer
                                echo '
                                <td>
                                    <input type="button" class ="submit supprimer" name="supprimer" value="Supprimer" data-id_rencontre ='.$donnees[5].'" onclick="setIdMatch(this.dataset.id_rencontre) ; showPopUpSupprimer()">
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
            function setIdMatch(id){
                idMatch = id;
            }

            function showPopUpSupprimer(){
                document.querySelector('.popup-supprimer').style.display = 'flex';
                console.log("Test showPopUpSupprimer");
            }
            
            function popUpOui(){
                document.querySelector('.popup-supprimer').style.display = 'none';
                window.location.href="listematch.php?idRencontreSupprimer=" + idMatch;
            }

            function popUpNon(){
                document.querySelector('.popup-supprimer').style.display = 'none';
            }
        </script>

    </body>
</html>