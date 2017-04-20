# Readme :


## Paramétrage de l'application :


    - Il est conseillé d'utiliser l'application avec Xampp et PhpMyAdmin :)
    - Changer tous les chemins dans Parametres.php selon le déploiement
    - Importer la bdd
    - Changer les noms des dossiers dans mainController.php / index.php si le nom change

## A la fin :
    - Changer les chemins des fichiers + accès bdd dans : index.php - class/Parametres.php
    - Changer noms des titres + textes
    - Ajouter nb de monstres restants dans l'onglet de lancement des parties
    - Écran de lancement : petit récapitulatif de la partie


## Objectifs du projet :



    - Une partie a : des monstres, un joueur, un état des pv du joueur (pour la save)
    - Lancer une partie en choisissant quels monstres et quel joueur on veut + leur nb (ajoutera des pv et marquera comme grp les ennemis)
    - Affichage d'un encadré avec le joueur + ses pdv restants
    - Gérer la page jeu
    - Affichage de l'encadré du monstre combattu
    - Gérer les combats entre le joueur et les monstres (un par un)
    - Affichage du tableau de score à l'accueil (ou dans un écran "score")
    - Ajouter une chance de bloquer les coups pour le joueur et les monstres (ajout d'un level ?)
    - Sauvegarder la partie en cours si le joueur n'est pas mort (après chaque combat ?)
    - Enregistrer le score à la fin de la partie
    - Ajouter des items : modifier le reste pour ça





## Changelog (ordre décroissant des objectifs réalisés) :


### Version 0.2 :




### Version 0.1 :

    + Petit encadré du joueur avec les monstres à tuer + ses pdv restants
    + Correction apportée : le nb de parties s'affiche désormais correctement dans lancement
    + Vérif avec le get pour savoir si le résultat de la partie est une partie pouvant être en cours
    + Ajout de la page de lancement pour les parties qui ont encore des monstres vivants
    + Ajout d'un message d'erreur si partie ajoutée sans monstre - joueur
    + Une partie concerne un ou plusieurs monstres.
    + Objet partie à alimenter

    + Association avec les monstres => état du monstre (battu ou non)

    + Passer l'accueil actuel en param => optimisation des pages (gestion d'onglets)
    + Une partie est relative à un joueur (relative créée)
    + Possibilité d'ajouter et supprimer des joueurs et monstres
    + Possibilité d'afficher les joueurs/monstres
    + Possibilité de modifier joueurs/monstres existants



