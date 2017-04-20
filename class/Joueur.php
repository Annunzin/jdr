<?php

class Joueur extends Entite {

    private $pseudo;
    private $score;
    private $vie_actuelle;

    public function __construct($pseudo, $id,$vie_max){

        // On initialise le constructeur parent

        parent::__construct($id,$vie_max);

        $this->pseudo = $pseudo;

        $this->score = 0;

        // La vie du personnage à l'initialisation
        $this->vie = $this->vie_max;

        // On fixe l'état du personnage à vivant
        $this->vivant = true;




    }

    public function getVieActuelle(){
        return $this->vie_actuelle;
    }

    public function setVieActuelle($vie){
        $this->vie_actuelle = $vie;
    }

    // récupère l'id du joueur
    public function getId(){
        return $this->id;
    }

    // récupère le nb de pdv
    public function getVie(){
        return $this->vie;
    }

    public function getPseudo(){
        return $this->pseudo;

    }




    /*
     * Fonction qui enregistre le joueur en base
     */
    public function enregistrer() {

        // On fait appel à la connexion PDO
        $pdo = Parametres::getPDO();
        $sql = $pdo->prepare('INSERT INTO joueur(joueur_id,joueur_pseudo,joueur_vie)
                              VALUES(null,?,?)');
        return $sql->execute(array($this->getPseudo(), $this->getVie()));
    }


    /**
     * Renvoie un objet Joueur correspondant à l'identifiant fourni
     * @param $id int : identifiant du joueur
     * @return bool|Joueur : false si l'identifiant ne correspond à rien
     */
    public static function getParId($id) {
        $id = (int) $id;
        $pdo = Parametres::getPDO();
        $sql = $pdo->prepare('SELECT * FROM joueur WHERE joueur_id = ?');
        $sql->execute(array($id));
        $res = $sql->fetch(PDO::FETCH_ASSOC);
        if(!empty($res))
            return new Joueur($res['joueur_pseudo'], $res['joueur_id'], $res['joueur_vie']);
        else
            return false;
    }



    // Récupère tous les joueurs
    public static function getAll() {
        $pdo = Parametres::getPDO();
        $res = $pdo->query("SELECT * FROM joueur")->fetchAll(PDO::FETCH_ASSOC);
        $output = array();
        foreach($res as $joueur) {
            $output[] = new Joueur( $joueur['joueur_pseudo'], $joueur['joueur_id'],$joueur['joueur_vie']);
        }
        return $output;
    }


    /**
     * Supprime un joueur en base
     * @param $id_joueur int : identifiant du joueur
     * @return bool : échec/succès de l'opération
     */
    public static function delete($id_joueur) {
        $pdo = Parametres::getPDO();
        $sql = $pdo->prepare("DELETE FROM joueur WHERE joueur_id = ?");
        return $sql->execute(array($id_joueur));
    }



    /**
     * Met à jour l'ensemble des joueurs en base
     * @param $tab array[id_joueur][champ1 ... champN] : tableau associatif contenant les nouvelles données
     */

    public static function updateJoueur($tab) {
        $pdo = Parametres::getPDO();
        foreach($tab as $id_joueur => $champs) {

            $pseudo = $champs['joueur_pseudo'];
            $vie = $champs['joueur_vie'];


            $sql = $pdo->prepare("UPDATE joueur SET joueur_vie = ?,joueur_pseudo = ? WHERE joueur_id = ?");
            $sql->execute(array($pseudo,$vie,$id_joueur));
        }
    }






} 
