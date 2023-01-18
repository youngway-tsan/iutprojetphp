<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - F.C. WOIPPY</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/index.css">
        <link rel="icon" href="img/FCWoippy-logo.png">
    </head>

    <body>
        <?php
        require_once("sql.php");
        $sql = new requeteSQL();
        $incorrect = false;

        session_start();
        $_SESSION["connected"] = False;
        if (isset($_POST['valider'])){
            if ($sql -> checkLogin($_POST['username'],$_POST['mdp'])){
                $_SESSION["connected"] = True;
                header('Location: accueil.php');
            } else {
                $incorrect = true;
            }
        }
        ?>
        <main class ="main-login main">
            <form action="" method="post">

                <div class ="img">
                    <img src="img/FCWoippy-logo.png" alt="" class="header-logo-link">
                </div>
                <hr>
                <div class="container">
                    <div class ="username">
                    <svg width="40px" height="40px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" version="1.1" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                        <rect height="10.5" width="12.5" y="2.75" x="1.75"/>
                        <circle cy="7.5" cx="8" r="2.25"/>
                        <path d="m4.75 12.75c0-1 .75-3 3.25-3s3.25 2 3.25 3"/>  
                    </svg>
                        <input type="text" name="username" placeholder="Identifiant" required>
                    </div>
                    
                    <div class ="mdp">
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 203.096 203.096" style="enable-background:new 0 0 203.096 203.096;" xml:space="preserve" width="40px" height="40px">
                                <path d="M153.976,73.236h-3.308V49.115C150.669,22.033,128.634,0,101.549,0C74.465,0,52.43,22.033,52.43,49.115v24.121H49.12
                                c-9.649,0-17.5,7.851-17.5,17.5v94.859c0,9.649,7.851,17.5,17.5,17.5h104.856c9.649,0,17.5-7.851,17.5-17.5V90.736
                                C171.476,81.087,163.626,73.236,153.976,73.236z M67.43,49.115C67.43,30.304,82.736,15,101.549,15
                                c18.813,0,34.119,15.304,34.119,34.115v24.121H67.43V49.115z M156.476,185.596c0,1.355-1.145,2.5-2.5,2.5H49.12
                                c-1.355,0-2.5-1.145-2.5-2.5V90.736c0-1.355,1.145-2.5,2.5-2.5H59.93h83.238h10.808c1.355,0,2.5,1.145,2.5,2.5V185.596z"/>
                                <path d="M101.547,116.309c-4.142,0-7.5,3.357-7.5,7.5v28.715c0,4.143,3.358,7.5,7.5,7.5c4.142,0,7.5-3.357,7.5-7.5v-28.715
                                C109.047,119.666,105.689,116.309,101.547,116.309z"/>
                        </svg>

                        <input type="password" name="mdp" placeholder="Mot de passe" required>
                    </div>
                    
                    <div class ="valider">
                        <input type="submit" name ="valider" value="Se Connecter">
                    </div>

                    <?php
                        if ($incorrect == true) {
                            echo '
                            <p class="erreur">
                                Identifiant ou Mot de passe incorrect
                            </p>
                            ';
                        }
                    ?>

                </div>
            </form>
        </main>
    </body>
</html>