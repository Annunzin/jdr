<?php


class Ennemi extends Entite implements \JsonSerializable{

    private $nom;
    private $espece;


    public function __construct($nom,$espece,$id,$vie_max,$degat_base){


        // On initialise le constructeur parent
        parent::__construct($id,$vie_max,$degat_base);


        $this->nom = $nom;
        $this->espece = $espece;

        // La vie du personnage à l'initialisation
        $this->vie = $this->vie_max;

        // On fixe l'état du personnage à vivant
        $this->vivant = true;




    }


    // pour envoyer les objets php en js
    public function jsonSerialize() {
        return get_object_vars($this);
    }


    // récupère l'id du monstre
    public function getId(){
        return $this->id;
    }


    // récupère le nb de pdv max
    public function getVie(){
        return $this->vie;
    }

    public function setVie($vie){
        $this->vie = $vie;
    }

    // récupère le nom du monstre
    public function getNom(){
        return $this->nom;
    }

    // récupère l'espèce du monstre
    public function getEspece(){
        return $this->espece;
    }


    /*
    * Fonction qui enregistre le monstre en base
    */
    public function enregistrer() {

        // On fait appel à la connexion PDO
        $pdo = Parametres::getPDO();
        $sql = $pdo->prepare('INSERT INTO ennemi(ennemi_id,ennemi_nom,ennemi_espece, ennemi_vie,ennemi_degat_base)
                              VALUES(null,?,?,?,?)');
        return $sql->execute(array($this->getNom(), $this->getEspece(),$this->getVie(),$this->getDegatBase()));
    }


    /**
     * Supprime un ennemi en base
     * @param $id_ennemi int : identifiant de l'ennemi
     * @return bool : échec/succès de l'opération
     */
    public static function delete($id_ennemi) {
        $pdo = Parametres::getPDO();
        $sql = $pdo->prepare("DELETE FROM ennemi WHERE ennemi_id = ?");
        return $sql->execute(array($id_ennemi));
    }

    // Récupère tous les ennemis
    public static function getAll() {
        $pdo = Parametres::getPDO();
        $res = $pdo->query("SELECT * FROM ennemi")->fetchAll(PDO::FETCH_ASSOC);
        $output = array();
        foreach($res as $ennemi) {
            $output[] = new Ennemi( $ennemi['ennemi_nom'],
                        $ennemi['ennemi_espece'],$ennemi['ennemi_id'],$ennemi['ennemi_vie'],$ennemi['ennemi_degat_base']);
        }
        return $output;
    }

    /*
     * Récupère les ennemis VIVANTS selon l'id de la partie
     */

    public static function getParPartie($id_partie) {
        $pdo = Parametres::getPDO();

        // Sélectionne les ennemis et les trie par ordre de PDV.
        $res = $pdo->prepare("SELECT * FROM ennemi
                            INNER JOIN composer ON ennemi.ennemi_id = composer.composer_ennemi_id
                            WHERE composer_partie_id = ?
                            AND composer_vivant =? ORDER BY ennemi_vie ASC");
        $res->execute(array($id_partie,1));

        $valeurs = $res->fetchAll(PDO::FETCH_ASSOC);



        $output = array();
        foreach($valeurs as $ennemi) {
            $output[] = new Ennemi( $ennemi['ennemi_nom'], $ennemi['ennemi_espece'],
                        $ennemi['ennemi_id'],$ennemi['ennemi_vie'],$ennemi['ennemi_degat_base']);
        }
        return $output;
    }



    /**
     * Met à jour l'ensemble des ennemis en base
     * @param $tab array[id_ennemi][champ1 ... champN] : tableau associatif contenant les nouvelles données
     */

    public static function updateEnnemi($tab) {
        $pdo = Parametres::getPDO();
        foreach($tab as $id_ennemi => $champs) {

            $nom = $champs['ennemi_nom'];
            $espece = $champs['ennemi_espece'];
            $degat_base = $champs['ennemi_degat_base'];

            $vie = $champs['ennemi_vie'];


            $sql = $pdo->prepare("UPDATE ennemi SET ennemi_nom = ?,ennemi_espece = ?,ennemi_vie =?,ennemi_degat_base=? WHERE ennemi_id = ?");
            $sql->execute(array($nom,$espece,$vie,$degat_base,$id_ennemi));
        }
    }
} 
