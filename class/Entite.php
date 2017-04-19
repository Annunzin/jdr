<?php


class Entite {


    protected $id;

    // à changer pour changer la valeur max
    protected $vie_max;


    // @var int : nombre de points de vie de l'entité
    protected $vie;

    // @var bool : état de l'entité (mort ou vivant)
    protected $vivant;


    // @var array : tableau d'objets (pour l'inventaire)
    protected $objets;

    public function __construct($id,$vie_max){

        $this->id = $id;

        $this->vie_max = $vie_max;

    }

    // On ajoute x pts à la vie
    public function modifierVie($nbPts){

        // Si le nb est positif
        if($nbPts >0){
            $this->vie = $this->vie + $nbPts;

            // On vérifie qu'on ne dépasse pas le seuil de vie max (par exemple en se soignant)
            if($this->vie>$this->vie_max){
                $this->vie = $this->vie_max;
            }
        }

        // S'il est négatif
        elseif($nbPts < 0){
            $this->vie = $this->vie - $nbPts;

            // On meurt si les pdv sont inférieurs à 0
            if ($this->vie < 0){
                $this->vivant = false;
            }
        }


    }

} 
