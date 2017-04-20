<?php

class Partie {


    private $id;
    private $id_joueur;
    private $lesEnnemis = array();
    private $est_en_cours;
    private $joueur_pseudo;
    private $nb_monstre;



    public function __construct($id,$id_joueur,$joueur_pseudo="",$nb_monstre=0){

        $this->id = $id;
        $this->id_joueur = $id_joueur;
        $this->est_en_cours = true;
        $this->joueur_pseudo = $joueur_pseudo;
        $this->nb_monstre = $nb_monstre;

    }

    public function getNbMonstre(){
        return $this->nb_monstre;
    }

    public function getJoueurPseudo(){
        return $this->joueur_pseudo;
    }

    public function getEnCours(){
        return $this->est_en_cours;
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
        $sql = $pdo->prepare('INSERT INTO partie(partie_id,partie_joueur_id,partie_en_cours)
                              VALUES(?,?,?)');
        return $sql->execute(array($this->getId(), $this->getIdJoueur(),$this->getEnCours()));
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


    // Récupère toutes les parties
    public static function getAll() {
        $pdo = Parametres::getPDO();



        $res = $pdo->query("SELECT partie_id, partie_joueur_id, joueur_pseudo, count(*) as nb_monstres
                            FROM partie
                            INNER JOIN joueur ON partie.partie_joueur_id = joueur.joueur_id
                            INNER JOIN composer ON partie.partie_id = composer.composer_partie_id
                            WHERE partie_en_cours = 1;;")->fetchAll(PDO::FETCH_ASSOC);
        $output = array();
        foreach($res as $partie) {
            $output[] = new Partie( $partie['partie_id'], $partie['partie_joueur_id'],$partie['joueur_pseudo'],$partie['nb_monstres']);
        }
        return $output;
    }


    public static function getDernierEnregistrement(){
        $pdo = Parametres::getPDO();
        $sql = $pdo->prepare("SELECT partie_id FROM partie ORDER BY partie_id DESC LIMIT 1");
        $sql->execute(array());
        return $sql->fetch(PDO::FETCH_COLUMN);


    }





    // TODO associer au tableau d'ennemis clé d'état ? vivant ou mort (true or false)




} 
