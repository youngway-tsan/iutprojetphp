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

    // Fonction qui retourne les joueurs
    public function getJoueurs()
    {
        $req = $this->linkpdo->prepare('SELECT * FROM joueur');
        $req->execute();
        return $req;
    }

      //Fonction qui retourne toute les informations d'un joueur grâce à son numéro de licence
      public function joueurId($licence)
      {
          $req = $this->linkpdo->prepare("SELECT * FROM joueur where Licence = :Licence");
          $req->execute(array(
              'Licence' => $licence
          ));
  
          return $req;
      }

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

    //Fonction qui retourne toute les informations d'un match grâce à son id
    public function matchId($id)
    {
        $req = $this->linkpdo->prepare("SELECT * FROM rencontre where Id_Rencontre = :id");
        $req->execute(array(
            'id' => $id
        ));

        return $req;
    }

    public function getMatch($param){
        $datetime = $param[0];
        $nomAdversaire = $param[1];
        $lieu = $param[2];

        if ($datetime == null and $nomAdversaire == null and $lieu == "default"){
            $req = $this->linkpdo->prepare("SELECT Nom_Equipe_Adverse, Date_Rencontre, Lieu_Rencontre, Id_Rencontre, Resultat FROM rencontre ORDER BY Date_Rencontre");
            $testreq = $req->execute();
        }else if ($datetime != null and $nomAdversaire == null and $lieu == "default"){ // DATE
        $req = $this->linkpdo->prepare("SELECT Nom_Equipe_Adverse, Date_Rencontre, Lieu_Rencontre, Id_Rencontre, Resultat FROM rencontre WHERE Date_Rencontre >= :date_match  ORDER BY Date_Rencontre");
        $testreq = $req -> execute(array(
            "date_match" => $datetime
            ));
        }else if ($datetime == null and $nomAdversaire != null and $lieu == "default"){ // NOM ADVERSAIRE
            $req = $this->linkpdo->prepare("SELECT Nom_Equipe_Adverse, Date_Rencontre, Lieu_Rencontre, Id_Rencontre, Resultat FROM rencontre where Nom_Equipe_Adverse = :nom");
            $testreq = $req -> execute(array(
                "nom" => $nomAdversaire
            ));
        } else if ($datetime == null and $nomAdversaire == null and $lieu != "default") { // LIEU
            $req = $this->linkpdo->prepare("SELECT Nom_Equipe_Adverse, Date_Rencontre, Lieu_Rencontre, Id_Rencontre, Resultat FROM rencontre where Lieu_Rencontre = :lieu");
            $testreq = $req -> execute(array(
                "lieu" => $lieu
            ));
        } else if ($datetime != null and $nomAdversaire != null and $lieu == "default") { // DATE + NOM ADVERSAIRE 
        $req = $this->linkpdo->prepare("SELECT Nom_Equipe_Adverse, Date_Rencontre, Lieu_Rencontre, Id_Rencontre, Resultat FROM rencontre where Date_Rencontre >= :date_match AND Nom_Equipe_Adverse = :nom ORDER BY Date_Rencontre ");
        $testreq = $req -> execute(array(
            "date_match" => $datetime,
            "nom" => $nomAdversaire
        ));
        } else if ($datetime != null and $nomAdversaire == null and $lieu != "default") { // DATE + LIEU 
        $req = $this->linkpdo->prepare("SELECT Nom_Equipe_Adverse, Date_Rencontre, Lieu_Rencontre, Id_Rencontre, Resultat FROM rencontre where Date_Rencontre >= :date_match AND Lieu_Rencontre = :lieu ORDER BY Date_Rencontre ");
        $testreq = $req -> execute(array(
            "date_match" => $datetime,
            "lieu" => $lieu
        ));
        } else if ($datetime == null and $nomAdversaire != null and $lieu != "default") { // NOM ADVERSAIRE + LIEU 
        $req = $this->linkpdo->prepare("SELECT Nom_Equipe_Adverse, Date_Rencontre, Lieu_Rencontre, Id_Rencontre, Resultat FROM rencontre where Nom_Equipe_Adverse = :nom AND Lieu_Rencontre = :lieu ");
        $testreq = $req -> execute(array(
            "nom" => $nomAdversaire,
            "lieu" => $lieu
        ));
        } else if ($datetime != null and $nomAdversaire != null and $lieu != "default") { // DATE + NOM ADVERSAIRE + LIEU 
        $req = $this->linkpdo->prepare("SELECT Nom_Equipe_Adverse, Date_Rencontre, Lieu_Rencontre, Id_Rencontre, Resultat FROM rencontre where Date_Rencontre >= :date_match AND Nom_Equipe_Adverse = :nom AND Lieu_Rencontre = :lieu ORDER BY Date_Rencontre ");
        $testreq = $req -> execute(array(
            "date_match" => $datetime,
            "nom" => $nomAdversaire,
            "lieu" => $lieu
        ));
        }

        if ($testreq == false){
            echo die("Erreur getMatch");
        }
        return $req;
    }

    /*
    FONCTIONS D'AJOUT DANS LA BDD
    */

    //Fonction qui permet d'ajouter un joueur dans la BDD
    public function addJoueur($licence,$nom,$prenom,$date_naissance,$taille,$poids,$poste,$image){
        $req = $this->linkpdo->prepare('INSERT INTO joueur VALUES (:licence,:nom,:prenom,:date_naissance,:taille,:poids,:poste,:statut,NULL,:image)');
        $testreq = $req->execute(
            array(
                'licence' => $licence,
                'nom' => $nom,
                'prenom' => $prenom,
                'date_naissance' => $date_naissance,
                'taille' => $taille,
                'poids' => $poids,
                'poste' => $poste,
                'statut' => 'Actif',
                'image' => $image
            )
        );
        if ($testreq == false) {
            die("Erreur addJoueur");
        }
    }

    //Fonction qui permet d'ajouter un match dans la BDD
    public function addMatch($date_rencontre,$nom_equipe_adverse,$lieu_rencontre){
        $req = $this->linkpdo->prepare('INSERT INTO rencontre VALUES (NULL,:date_rencontre,:nom_equipe_adverse,:lieu_rencontre,NULL)');
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

    public function modifierJoueur($licence,$nom,$prenom,$date_naissance,$taille,$poids,$poste,$image){
        $req = $this->linkpdo->prepare('UPDATE joueur SET Nom = :nom,Prenom = :prenom, Date_naissance = :date_naissance,Taille =:taille, Poids = :poids,Poste =:poste,Image =:image WHERE Licence = :licence');
        $testreq = $req->execute(
            array(
                'licence' => $licence,
                'nom' => $nom,
                'prenom' => $prenom,
                'date_naissance' => $date_naissance,
                'taille' => $taille,
                'poids' => $poids,
                'poste' => $poste,
                'image' => $image
            )
        );
        if ($testreq == false) {
            die("Erreur modifierJoueur");
        }
    }

    public function modifierMatch($id,$datetime,$nomAdversaire,$lieu){
        $req = $this->linkpdo->prepare('UPDATE rencontre SET Date_Rencontre = :date_match,Nom_Equipe_Adverse = :nomAdversaire, Lieu_Rencontre = :lieu WHERE Id_Rencontre = :id');
        $testreq = $req->execute(
            array(
                'date_match' => $datetime,
                'id' => $id,
                'nomAdversaire' => $nomAdversaire,
                'lieu' => $lieu
            )
        );
        if ($testreq == false) {
            die("Erreur modifierMatch");
        }
    }

    public function modifierScoreMatch($id,$score){
        $req = $this->linkpdo->prepare('UPDATE rencontre SET Resultat = :score WHERE Id_Rencontre = :id');
        $testreq = $req->execute(
            array(
                'id' => $id,
                'score' => $score
            )
        );
        if ($testreq == false) {
            die("Erreur modifierMatch");
        }
    }


    /*
    FONCTION SUPPRIMER DE LA BDD
    */






}

?>