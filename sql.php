<?php
class requeteSQL {

    private $linkpdo;

    public function __construct()
    {
        ///Connexion au serveur MySQL avec PDO
        $server = 'localhost';
        $login  = 'root';
        $mdp    = '';
        $db     = 'id19876426_iutprojetphp';

        try {
            $this->linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp);
            $this->linkpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        ///Capture des erreurs éventuelles
        catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    //Fonction qui permet de check si l'id et le mdp sont correct (return true ou false)
    public function checkLogin($id,$mdp){
        $req = $this->linkpdo->prepare("SELECT count(*) FROM entraineur WHERE identifiant = :id AND mdp = :mdp");
        $testreq = $req -> execute(array(
            'id' => $id,
            'mdp' => $mdp));
        if ($testreq == false){
            die("Erreur checkLogin");
        }

        $result = $req->fetch();
        if ($result[0] != 0){
            return true;
        } else {
            return false;
        }
    }
    
    /*
    FONCTIONS D'AJOUT DANS LA BDD
    */

    //Fonction qui permet d'ajouter un joueur dans la BDD
    public function addJoueur($licence,$nom,$prenom,$date_naissance,$taille,$poids,$poste){
        $req = $this->linkpdo->prepare('INSERT INTO joueur VALUES (:licence,:nom,:prenom,:date_naissance,:taille,:poids,:poste)');
        $testreq = $req->execute(
            array(
                'licence' => $licence,
                'nom' => $nom,
                'prenom' => $prenom,
                'date_naissance' => $date_naissance,
                'taille' => $taille,
                'poids' => $poids,
                'poste' => $poste
            )
        );
        if ($testreq == false) {
            die("Erreur addJoueur");
        }
    }

    //Fonction qui permet d'ajouter un match dans la BDD
    public function addMatch($date_rencontre,$nom_equipe_adverse,$lieu_rencontre){
        $req = $this->linkpdo->prepare('INSERT INTO rencontre VALUES (NULL,:date_rencontre,:nom_equipe_adverse,:lieu_recontre)');
        $testreq = $req->execute(
            array(
                'date_rencontre' => $date_rencontre,
                'nom_equipe_adverse' => $nom_equipe_adverse,
                'lieu_rencontre' => $lieu_rencontre
            )
        );

        if ($testreq == false){
            die('Erreur addMatch');
        }
    }

    /*
    FONCTION DE MODIFICATION DE LA BDD
    */




}

?>