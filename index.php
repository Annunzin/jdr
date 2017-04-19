<?php
// Tout part d'ici

// charge automatiquement les classes nécessaires à l'utilisation
// TODO : modifier jdr par le nom du dossier
function __autoload($class_name) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/jdr/class/' . $class_name . '.php';
}

// TODO : modifier jdr par le nom du dossier

require_once $_SERVER['DOCUMENT_ROOT'] . '/jdr/controller/MainController.php';

// On instancie le nouveau controller
$mc = new MainController();

// S'il n'y a pas de page récupérée ou si la page est la page d'accueil
if(!isset($_GET['page']) || empty($_GET['page']) || $_GET['page'] == 'accueil') {

    // Va chercher la fonction d'appel à la page d'accueil dans le controller
    $mc->pageAccueil();
}


else {
    switch($_GET['page']) {

        case 'parametres' :
            $mc->pageParametres();
            break;

        case 'creation':
            $mc->pageCreation();
            break;

        // On va à la page d'accueil par défaut
        default :
            $mc->pageAccueil();
            break;
    }
}


