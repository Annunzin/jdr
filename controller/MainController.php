<?php



// Classe qui gérera les redirections
class MainController{


    // Gère l'affichage de la page d'accueil
    public function pageAccueil(){


        // On inclue la vue
        include_once 'pages/accueil.php';
    }


    public function pageCreation(){


        if(isset($_POST)&& !empty($_POST)){

            $id_joueur = $_POST['joueur_choisi'];

            $partie = new Partie(null,$id_joueur);


            // On enregistre la partie en base
            $partie->enregistrer();

            // On récupère le dernier enregistrement (pour avoir l'id)
            $partie = Partie::getDernierEnregistrement();




            foreach($_POST['monstre_choisi'] as $id_monstre){

                // envoie l'id du dernier enregistrement + l'id des monstres
                Partie::composerPartie($partie[0],$id_monstre);

            }

            // alimente un tableau de retour

            $message_retour = array('erreur' => false, 'message' => 'La partie a bien été créée !');
        }


        $lesMonstres = Ennemi::getAll();
        $lesJoueurs = Joueur::getAll();

        include_once 'pages/creation.php';
    }


    public function pageParametres(){


        // Si on a ajouté une valeur (monstre, joueur...)
        if(isset($_POST) && !empty($_POST)) {

            /**
             * Nouveau joueur
             */
            if(isset($_POST['quoi']) && $_POST['quoi'] == "ajout_joueur") {

                // Pour éviter que l'user saisisse n'importe quoi
                $pseudo = htmlspecialchars($_POST['joueur_pseudo']);
                $vie = (int) $_POST['joueur_vie'];

                // Vie définira la vie max du joueur
                $joueur = new Joueur($pseudo,null,$vie);

                // On enregistre en bdd le joueur
                $joueur->enregistrer();
            }

            /**
             * Nouveau monstre
             */
            if(isset($_POST['quoi']) && $_POST['quoi'] == "ajout_monstre") {

                // Pour éviter que l'user saisisse n'importe quoi
                $nom = htmlspecialchars($_POST['monstre_nom']);
                $espece = htmlspecialchars($_POST['monstre_espece']);

                $vie = (int) $_POST['monstre_vie'];

                // Vie définira la vie max du monstre
                $monstre = new Ennemi($nom,$espece,null,$vie);

                // On enregistre en bdd le monstre
                $monstre->enregistrer();
            }


            /**
             * Supprimer joueur
             */
            if(isset($_POST['supprimer_joueur'])){


                $id = $_POST['supprimer_joueur'];

                Joueur::delete($id);



                // alimente un tableau de retour
                $message_retour = array('erreur' => false, 'message' => 'Le joueur a bien été supprimé !');


            }


            /**
             * Supprimer monstre
             */
            if(isset($_POST['supprimer_monstre'])){

                $id = $_POST['supprimer_monstre'];

                Ennemi::delete($id);

                // alimente un tableau de retour

                $message_retour = array('erreur' => false, 'message' => 'Le monstre a bien été supprimé !');


            }

            /**
             * Mise à jour joueurs existants
             */
            if(isset($_POST['action']) && $_POST['action'] == "updateJoueur") {
                $update = array();
                foreach($_POST as $key => $val) {
                    if(strpos($key, '@') === false) continue;
                    list($joueur_id, $attr) = explode('@', $key);
                    $update[$joueur_id]['joueur_' . $attr] = $val;
                }
                Joueur::updateJoueur($update);

                $message_retour = array('erreur' => false, 'message' => 'Les joueurs ont bien été modifiés !');

            }

            /**
             * Mise à jour joueurs existants
             */
            if(isset($_POST['action']) && $_POST['action'] == "updateMonstre") {
                $update = array();
                foreach($_POST as $key => $val) {
                    if(strpos($key, '@') === false) continue;
                    list($monstre_id, $attr) = explode('@', $key);
                    $update[$monstre_id]['ennemi_' . $attr] = $val;
                }
                Ennemi::updateEnnemi($update);
                $message_retour = array('erreur' => false, 'message' => 'Les monstres ont bien été modifiés !');

            }






        }


        $lesMonstres = Ennemi::getAll();
        $lesJoueurs = Joueur::getAll();

        // On inclue la vue
        include_once 'pages/parametres.php';
    }

}
