<?php


class Entite {


    protected $id;

    // à changer pour changer la valeur max
    protected $vie_max;


    // @var int : nombre de points de vie de l'entité
    protected $vie;

    // @var bool : état de l'entité (mort ou vivant)
    protected $vivant;

    // @var int : dégâts de base de l'entité
    protected $degat_base;


    // @var array : tableau d'objets (pour l'inventaire)
    protected $objets;

    public function __construct($id,$vie_max,$degat_base){

        $this->degat_base = $degat_base;

        $this->id = $id;

        $this->vie_max = $vie_max;

    }

    public function getDegatBase(){
        return $this->degat_base;
    }



} 
