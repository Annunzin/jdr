<?php

class Partie {


    private $id;
    private $id_joueur;
    private $lesEnnemis = array();



    public function __construct($id,$id_joueur){

        $this->id = $id;
        $this->id_joueur = $id_joueur;


    }

    public function getId(){
        return $this->id;
    }


    public function getIdJoueur(){
        return $this->id_joueur;
    }

    /*
     * Fonction qui enregistre la partie en base
     */
    public function enregistrer() {

        // On fait appel à la connexion PDO
        $pdo = Parametres::getPDO();
        $sql = $pdo->prepare('INSERT INTO partie(partie_id,partie_joueur_id)
                              VALUES(?,?)');
        return $sql->execute(array($this->getId(), $this->getIdJoueur()));
    }



    /*
     * Fonction qui alimente les monstres de la partie en base
     */
    public static function composerPartie($partie_id,$ennemi_id){
        // On fait appel à la connexion PDO
        $pdo = Parametres::getPDO();
        $sql = $pdo->prepare('INSERT INTO composer(composer_partie_id,composer_ennemi_id,composer_vivant)
                              VALUES(?,?,1)');
        return $sql->execute(array($partie_id,$ennemi_id));



    }


    public static function getDernierEnregistrement(){
        $pdo = Parametres::getPDO();
        $sql = $pdo->prepare("SELECT partie_id FROM partie ORDER BY partie_id DESC LIMIT 1");
        $sql->execute(array());
        return $sql->fetch(PDO::FETCH_COLUMN);


    }





    // TODO associer au tableau d'ennemis clé d'état ? vivant ou mort (true or false)




} 
