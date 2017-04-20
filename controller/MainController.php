<?php

class MainController {

    public function pageAccueil() {
        $anom_ok = Anomalie::existeAnomalie();

        // Test d'anomalie pour le clignotement du menu
        if($anom_ok['nb'] > 0){

            $anom_ok = "anomalie";
        }

        else{
            $anom_ok = "rien";
        }

        include_once '_views/accueil.php';
    }




    // TODO GESTION DES GESTIONNAIRES
    public function pageFlux() {

        $semainesEclatees = array('s', 's_p1', 's_p2');

        //echo '<pre>'; var_dump($_POST); echo '</pre>';


        $lesSemaines = ToolBox::getWeeksRange(20);

        if(isset($_POST) && !empty($_POST) && isset($_POST['quoi']) && $_POST['quoi'] == 'maj') {

            $update_data = array();
            foreach($_POST as $key => $val) {
                if(strpos($key, '@') !== false) {
                    list($id_pdt, $champ) = explode('@', $key);
                    $update_data[$id_pdt][$champ] = $val;
                }
            }
            Updater::updateLignesPrev($update_data);
        }

        // Gestion de la ligne
        $lesLignes = Ligne::getAll();
        if(isset($_POST) && isset($_POST['ligne']) && !empty($_POST['ligne'])) {
            $id_ligne = (int) $_POST['ligne'];
            $ligneSelect = Ligne::loadById($id_ligne);
        } else {
            $ligneSelect = $lesLignes[0];
        }
        // Gestion du groupe
        $lesGroupes = $ligneSelect->getGroupes();
        if(isset($_POST) && isset($_POST['groupe']) && !empty($_POST['groupe'])) {
            $id_select_groupe = (int) $_POST['groupe'];
        }
        else {
            $id_select_groupe = $lesGroupes[0]->getId();
        }



        $lesGestionnaires = Gestionnaire::getAll();

        if(isset($_POST) && isset($_POST['gest']) && !empty($_POST['gest'])) {
            $id_select_gest = (int) $_POST['gest'];
        } else {
            $id_select_gest = -1;
        }
        // Fin gestionnaire


        $lesTypes = array('MTO + MTS', 'MTO', 'MTS');
        $typeSelect = isset($_POST['type']) && !empty($_POST['type']) && $_POST['type'] != "MTO + MTS"
            ? htmlspecialchars($_POST['type'])
            : $lesTypes[0];
        $lesTypes2 = array('EBC + CID', 'EBC', 'CID');
        $type2Select = isset($_POST['type2']) && !empty($_POST['type2']) && $_POST['type2'] != "EBC + CID"
            ? htmlspecialchars($_POST['type2'])
            : $lesTypes2[0];


        if($id_select_gest != -1){


            $lesProduits = Produit::getParGestionnaireEtTypes($id_select_gest, $typeSelect, $type2Select,$ligneSelect->getId(),$id_select_groupe);

        }
        elseif($id_select_groupe == -1) {
            $lesProduits = Produit::getParLigneEtTypes($ligneSelect->getId(), $typeSelect, $type2Select);
        }
        else {
            $lesProduits = Produit::getParGroupeEtTypes($id_select_groupe, $typeSelect, $type2Select);
        }
        $total_pdp = Produit::getSommesPDP($lesProduits);
        $total_prevs = Produit::getSommesPrevLivr($lesProduits);
        $total_prevs_lissage = Produit::getSommesPrevLissage($lesProduits);
        $lesLignes = Ligne::getAll();
        include_once '_views/flux.php';
    }



    // Création pageMems
    // Page mems 1 (Bruno)
    public function pageMems() {

        $semainesEclatees = array('s', 's_p1', 's_p2');

        //echo '<pre>'; var_dump($_POST); echo '</pre>';


        $lesSemaines = ToolBox::getWeeksRange(20);



        // TODO : pour numéro lot et nb plaques
        if(isset($_POST) && !empty($_POST) && isset($_POST['quoi']) && $_POST['quoi'] == 'maj') {
            $update_data = array();
            foreach($_POST as $key => $val) {
                if(strpos($key, '@') !== false) {
                    list($id_mems, $champ) = explode('@', $key);
                    $update_data[$id_mems][$champ] = $val;

                }
            }




            UpdaterMems::updateLignesPrev($update_data);
        }


        // Gestion du tri
        if(isset($_POST) && isset($_POST['tri']) && !empty($_POST['tri'])) {
            $id_select_tri = $_POST['tri'];
        }
        else {
            $id_select_tri = -1;
        }




        /*
        $lesTypes = array('RESA + SECONDAIRE', 'RESA', 'SECONDAIRE');
        $typeSelect = isset($_POST['type']) && !empty($_POST['type']) && $_POST['type'] != "RESA + SECONDAIRE"
            ? htmlspecialchars($_POST['type'])
            : $lesTypes[0];
        */


        $lesMems = Mems::getAllBruno();

        $lesCellules = Mems::getAllCellulesBruno();


        //$total_prevs = Mems::getSommesPrevLivr($lesMems);
        include_once '_views/mems.php';

    }



    // Création pageMems
    // TODO
    // Page mems 2 (herve)
    public function pageMems2() {

        $semainesEclatees = array('s', 's_p1', 's_p2');

        //echo '<pre>'; var_dump($_POST); echo '</pre>';


        $lesSemaines = ToolBox::getWeeksRange(20);



        // TODO : pour numéro lot et nb plaques
        if(isset($_POST) && !empty($_POST) && isset($_POST['quoi']) && $_POST['quoi'] == 'maj') {
            $update_data = array();
            foreach($_POST as $key => $val) {
                if(strpos($key, '@') !== false) {
                    list($id_mems, $champ) = explode('@', $key);
                    $update_data[$id_mems][$champ] = $val;

                }
            }





            UpdaterMems::updateLignesPrev($update_data);
        }







        /*
        $lesTypes = array('RESA + SECONDAIRE', 'RESA', 'SECONDAIRE');
        $typeSelect = isset($_POST['type']) && !empty($_POST['type']) && $_POST['type'] != "RESA + SECONDAIRE"
            ? htmlspecialchars($_POST['type'])
            : $lesTypes[0];
        */


        $lesMems = Mems::getAllHerve();



        //$total_prevs = Mems::getSommesPrevLivr($lesMems);
        include_once '_views/mems2.php';

    }


    public function pageLancement() {

        /**
         * Mise à jour des lignes lancement
         */
        if(isset($_POST) && !empty($_POST)) {
            //echo '<pre>'; var_dump($_POST); echo '</pre>';
            $update_data = array();
            foreach($_POST as $key => $val) {
                if(strpos($key, '@') !== false) {
                    list($id_pdt, $champ) = explode('@', $key);
                    $update_data[$id_pdt][$champ] = $val;
                }
            }
            Updater::updateLignesLancement($update_data);
        }

        /**
         * Préparation des données pour affichage
         */
        $lesSemaines = ToolBox::getWeeksRange(8);

        // Gestion de la ligne
        $ligneSelect = Ligne::loadByLibelle('LE');

        // Gestion du groupe
        $lesGroupes = $ligneSelect->getGroupes();
        if(isset($_POST) && isset($_POST['groupe']) && !empty($_POST['groupe'])) {
            $id_select_groupe = (int) $_POST['groupe'];
        } else {
            $id_select_groupe = $lesGroupes[0]->getId();
        }




        if($id_select_groupe == -1) {
            // 01/09/16 Manque le dernier paramètre, type string, rajout d'un paramètre vide
            $lesProduits = Produit::getParLigneEtTypes($ligneSelect->getId(), 'MTO', '');
        }
        else {
            // 01/09/16 Idem au dessus
            $lesProduits = Produit::getParGroupeEtTypes($id_select_groupe, 'MTO', '');
        }


        $lancement = Produit::getSommeLancement($lesProduits);

        /**
         * Appel de la vue
         */
        include_once '_views/lancement.php';
    }

    public function pageParam($bddp ="") {



        // Renvoyer à la page d'ajout de produit
        if(isset($_POST['anom']) && $_POST['anom'] == 'Corriger l\'anomalie') {


            $bddp = $_POST['bddp'];


        }


        if(isset($_POST) && !empty($_POST)) {

            /**
             * Nouvelle ligne
             */
            if(isset($_POST['quoi']) && $_POST['quoi'] == "ajout_ligne") {
                $libelle = mb_strtoupper(htmlspecialchars($_POST['ligne_libelle']), 'utf-8');
                $division = (int) $_POST['ligne_division'];
                $ligne = new Ligne(null, $libelle, $division);
                $ligne->enregistrer();
            }

            /**
             * Nouveau groupe
             */
            if(isset($_POST['quoi']) && $_POST['quoi'] == "ajout_groupe") {
                $libelle = mb_strtoupper(htmlspecialchars($_POST['groupe_libelle']), 'utf-8');
                $id_ligne = (int) $_POST['groupe_ligne'];
                $groupe = new Groupe(null, $libelle, $id_ligne);
                $groupe->enregistrer();
            }

            /**
             * Nouveau produit
             */
            if(isset($_POST['quoi']) && $_POST['quoi'] == "ajout_produit") {
                $bddp = mb_strtoupper(htmlspecialchars($_POST['bddp_produit']), 'utf-8');
                $libelle = mb_strtoupper(htmlspecialchars($_POST['libelle_produit']), 'utf-8');
                $sap = (int) $_POST['sap_produit'];

                $id_groupe = (int) $_POST['groupe_produit'];
                $ebc = isset($_POST['ebc_produit']) && $_POST['ebc_produit'] == 'on';
                $cid = isset($_POST['cid_produit']) && $_POST['cid_produit'] == 'on';
                $specifique = isset($_POST['specifique'])  && $_POST['specifique'] == 'on';
                $type = htmlspecialchars($_POST['type_produit']);
                $produit = new Produit(null, $bddp, $sap, $libelle, $ebc,$specifique, $cid, $type, null, null, array(),array(), array(), array(), array(), array(), array(), array());
                $produit->ajouter($id_groupe);
            }

            /**
             * Nouvel opérateur
             */
            if(isset($_POST['quoi']) && $_POST['quoi'] == "ajout_operateur") {
                $nom = mb_strtoupper(htmlspecialchars($_POST['operateur_nom']), 'utf-8');
                $id_ligne = (int) $_POST['operateur_ligne'];
                $ope = new Operateur(null, $nom, $id_ligne);
                $ope->enregistrer();
            }

            /**
             * Mise à jour produits existants
             */
            if(isset($_POST['action']) && $_POST['action'] == "update") {
                $update = array();
                foreach($_POST as $key => $val) {
                    if(strpos($key, '@') === false) continue;
                    list($pdt_id, $attr) = explode('@', $key);
                    $update[$pdt_id]['pdt_' . $attr] = $val;
                }
                Updater::paramProduits($update);
            }
        }


        /**
         * Données (lignes avec groupes associés, groupes avec produits associés)
         */
        $lesGestionnaires = Gestionnaire::getAll();
        $lesLignes = Ligne::getAll();
        if(isset($_POST['ligne_choisie'])) {
            
            $ligne_choisie = (int) $_POST['ligne_choisie'];
            $laLigne = Ligne::loadById($ligne_choisie);

        }

        elseif(isset($_GET['Ligne'])) {

            if($_GET['Ligne'] == 'CPT'){
                $laLigne = Ligne::loadById(13);
                $ligne_choisie = 13;

            }

            else{
                $laLigne = Ligne::loadById(14);
                $ligne_choisie = 14;

            }
        }

        else {
            $ligne_choisie = $lesLignes[0]->getId();
            $laLigne = $lesLignes[0];
        }








        /**
         * Listes déroulantes pour les groupes
         */
        $lesGroupesSelect = Groupe::getAll();
        $produitsParPage=25; //Nous allons afficher 25 produits par page.
        // On compte les produits
        $produitsTotal = $laLigne->getNbProduits();

        // On calcule le nb de pages
        $nombreDePages=ceil($produitsTotal['nb']/$produitsParPage);


        if(isset($_GET['Page'])){
            $pageActuelle=intval($_GET['Page']);

            if($pageActuelle>$nombreDePages){
                $pageActuelle=$nombreDePages;
            }
        }
        else{

            $pageActuelle=1; // La page actuelle est la n°1
        }



        include_once '_views/param.php';
    }





    public function pageParamMems($bddp ="") {


        if(isset($_POST) && !empty($_POST)) {



            /**
             * Nouveau mems
             */
            if(isset($_POST['quoi']) && $_POST['quoi'] == "ajout_mems") {
                $bddp = mb_strtoupper(htmlspecialchars($_POST['bddp_mems']), 'utf-8');
                $libelle = mb_strtoupper(htmlspecialchars($_POST['libelle_mems']), 'utf-8');
                $sap = (int) $_POST['sap_mems'];
                $famille = $_POST['famille_mems'];

                $bruno = 0;
                $herve = 0;
                if(isset($_POST['bruno_mems']) && $_POST['bruno_mems'] == 'on'){
                    $bruno = 1;
                }

                if(isset($_POST['herve_mems']) && $_POST['herve_mems'] == 'on'){
                    $herve = 1;
                }

                $mems = new Mems(null, $bddp, $sap, $libelle, 1,$bruno,$herve,$famille, 1, 1, null, 0, array(), array(), array(), array(), array(), array());
                $mems->ajouter();
            }


            /**
             * Mise à jour mems existants
             */
            if(isset($_POST['action']) && $_POST['action'] == "update") {
                $update = array();
                foreach($_POST as $key => $val) {
                    if(strpos($key, '@') === false) continue;
                    list($mems_id, $attr) = explode('@', $key);
                    $update[$mems_id]['mems_' . $attr] = $val;
                }
                UpdaterMems::paramMems($update);
            }
        }




        $lesMems = Mems::getParTypes();



        $lesCellules = Mems::getAllCellules();



        $produitsParPage=25; //Nous allons afficher 25 produits par page.
        // On compte les produits
        $produitsTotal = Mems::getNbProduits();

        // On calcule le nb de pages
        $nombreDePages=ceil($produitsTotal['nb']/$produitsParPage);


        if(isset($_GET['Page'])){
            $pageActuelle=intval($_GET['Page']);

            if($pageActuelle>$nombreDePages){
                $pageActuelle=$nombreDePages;
            }
        }
        else{

            $pageActuelle=1; // La page actuelle est la n°1
        }


        include_once '_views/paramMems.php';
    }




    // Ajout de la fonction de la page d'Anomalie

    public function pageAnomalie() {


        // Récupère la tableau d'anomalies
        $lesAnomalies = Anomalie::getAll();

        include_once '_views/anomalie.php';





    }
}
