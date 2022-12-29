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
    FONCTIONS D'INTERROGATION DE LA BDDQ
    */

    public function getJoueur($param){
        $nom = $param[0];
        $prenom = $param[1];
        $poste = $param[2];

        if ($nom == null and $prenom == null and $poste == "default"){
            $req = $this->linkpdo->prepare("SELECT nom, prenom, commentaire, statut, licence FROM joueur ORDER BY nom");
            $testreq = $req->execute();
        }else if ($nom != null and $prenom == null and $poste == "default" ){ // NOM
            $req = $this->linkpdo->prepare("SELECT nom, prenom, commentaire, statut, licence FROM joueur where nom = :nom");
            $testreq = $req -> execute(array(
                "nom" => $nom
            ));
        } else if ($nom == null and $prenom != null  and $poste == "default"){ // PRENOM
            $req = $this->linkpdo->prepare("SELECT nom, prenom, commentaire, statut, licence FROM joueur WHERE prenom = :prenom");
            $testreq = $req -> execute(array(
                "prenom" => $prenom
            ));
        } else if ($nom == null and $prenom == null and $poste != "default") { // POSTE
            $req = $this->linkpdo->prepare("SELECT nom, prenom, commentaire, statut, licence FROM joueur WHERE poste = :poste");
            $testreq = $req -> execute(array(
                "poste" => $poste
            ));
        } else if ($nom != null and $prenom != null and $poste == "default"){ // NOM + PRENOM
            $req = $this->linkpdo->prepare("SELECT nom,prenom, commentaire, statut, licence FROM joueur WHERE nom = :nom AND prenom = :prenom");
            $testreq = $req->execute(
                array(
                    "nom" => $nom,
                    "prenom" => $prenom
                )
            );
        } else if ($nom != null and $prenom == null and $poste != "default") { // NOM + POSTE
            $req = $this->linkpdo->prepare("SELECT nom,prenom, commentaire, statut, licence FROM joueur WHERE nom = :nom AND poste = :poste");
            $testreq = $req->execute(
                array(
                    "nom" => $nom,
                    "poste" => $poste
                )
            );
        }else if ($nom == null and $prenom != null and $poste != "default"){ // PRENOM + POSTE
            $req = $this->linkpdo->prepare("SELECT nom,prenom, commentaire, statut, licence FROM joueur WHERE prenom = :prenom AND poste =:poste");
            $testreq = $req->execute(
                array(
                    "prenom" => $prenom,
                    "poste" => $poste
                )
            );
        } else if ($nom != null and $prenom != null and $poste != "default") { // NOM + PRENOM + POSTE
            $req = $this->linkpdo->prepare("SELECT nom,prenom, commentaire, statut, licence FROM joueur WHERE nom = :nom AND prenom = :prenom AND poste = :poste");
            $testreq = $req->execute(
                array(
                    "nom" => $nom,
                    "prenom" => $prenom,
                    "poste" => $poste
                )
            );
        }
        
        if ($testreq == false){
            die("Erreur getJoueur");
        }
        return $req;
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