<!DOCTYPE html>
<html>
    <head>

    </head>

    <body>
        <p>Test</p>
        <?php
            ///Connexion au serveur MySQL avec PDO
            $server = 'localhost';
            $login  = 'id19876426_theadministrator';
            $mdp    = '0PBP<1vWicNXl+4^';
            $db     = 'id19876426_iutprojetphp';

            try {
                $linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp);
                $linkpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo 'connexion réussie';
            }
            ///Capture des erreurs éventuelles
            catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
        ?>
    </body>
</html>