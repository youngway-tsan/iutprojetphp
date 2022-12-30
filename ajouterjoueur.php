<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ajouter un joueur - F.C. WOIPPY</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="img/FCWoippy-logo.png">
    </head>

    <?php
        require_once("header.php");
        $header = new header();
        // Initialisation des variables
        $info_execution = "";
    ?>

    <body>
        <main class="main-creation-joueur">
            <section class="creation-tournoi-container">
                <form action="ajouterjoueur.php" method="POST">

                    <h1 class="creation-tournoi-title">Ajouter un joueur</h1>
                    <div class="creation-tournoi">
                        <div class="creation-tournoi-left">
                            <div class="creation-tournoi-input">
                                <label for="nom-joueur">Nom du joueur</label>
                                <input type="text" name="nom-joueur" id="nom-joueur">
                            </div>
                            <div class="creation-tournoi-input">
                                <label for="prenom-joueur">Prénom du joueur</label>
                                <input type="text" name="prenom-joueur" id="prenom-joueur">
                            </div>
                            <div class="creation-tournoi-input">
                                <label for="licence-joueur">Licence du joueur</label>
                                <input type="text" name="licence-joueur" id="licence-joueur">
                            </div>
                            <div class="creation-tournoi-input">
                                <label for="dtn_joueur">Date de naissance</label>
                                <input type="date" name="dtn-joueur" id="dtn-joueur">
                            </div>
                        </div>

                            <div class="creation-tournoi-right">
                                <div class="creation-tournoi-input">
                                    <label for="combobox-poste-joueur">Poste</label>
                                    <select name="combobox-poste-joueur" id="combobox-poste-joueur">
                                        <option value="Gardien">Gardien</option>
                                        <option value="Défenseur">Défenseur</option>
                                        <option value="Milieu">Milieu</option>
                                        <option value="Attaquant">Attaquant</option>
                                    </select>
                                </div>
                                <div class="creation-tournoi-input">
                                    <label for="taille-joueur">Taille du joueur (en cm)</label>
                                    <input type="number" id="taille-joueur" name="taille-joueur" min="1" max="250">
                                </div>
                                <div class="creation-tournoi-input">
                                    <label for="poids-joueur">Poids du joueur (en kg)</label>
                                    <input type="number" id="poids-joueur" name="poids-joueur" min="1" max="150">
                                </div>
                                <div class="creation-tournoi-input">
                                    <label for="date-fin">Photo du joueur</label>
                                    <input type="date" name="date-fin" id="date-fin">
                                </div>
                            </div>
                    </div>
                    <input class="submit" type="submit" name="ajouter" value="Ajouter">
                    <span><?php echo $info_execution?> </span>
                </form>
            </section>
        </main>
    </body>


</html>
