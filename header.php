<?php
class header{
    public function __construct(){
        echo '
        <header>
            <div class="topnavbar">
                <div class ="navbar-haut">
                    <div class="nav-container-haut">
                        <div></div>
                        <a class="header-logo-link" href="accueil.php">
                            <img src="img/FCWoippy-logo.png" alt="" class="navbar-logo">
                        </a>
                        <form action="" method="post">
                            <input type="submit" name="Déconnexion" value="Déconnexion">
                        </form>
                    </div>
                </div>
                <div class="navbar-menu-div">
                <ul class="navbar-menu">
                    <li class="navbar-item"><a href="accueil.php" class="navbar-link">Accueil</a></li>
                    <li class="navbar-item"><a href="#" class="navbar-link">Joueurs</a>
                        <ul class="sousmenu">
                            <li class="navbar-item"><a href="ajouterjoueur.php" class="navbar-link">Ajouter un joueur</a></li>
                            <li class="navbar-item"><a href="listejoueur.php" class="navbar-link">Liste des joueurs</a></li>
                        </ul>
                    </li>
                    <li class="navbar-item"><a href="#" class="navbar-link">Matchs</a>
                        <ul class="sousmenu">
                            <li class="navbar-item"><a href="ajoutermatch.php" class="navbar-link">Ajouter un match</a></li>
                            <li class="navbar-item"><a href="listematch.php" class="navbar-link">Liste des matchs</a></li>
                        </ul>
                    </li>
                    <li class="navbar-item"><a href="#" class="navbar-link">Statistiques</a></li>
                </ul>
                </div>
            </div>
        </header>
        ';
    }
}
?>