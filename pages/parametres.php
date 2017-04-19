<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>JDR - Params</title>
    <link rel="stylesheet" href="pages/lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="pages/style/style.css">
</head>
<body>

<div class="container">


<!-- Renvoie le tableau de message de retour s'il y'en a un -->
<?php if(isset($message_retour)) { ?>
    <div class="row">
        <div class="col-lg-3 col-md-1">&nbsp;</div>
        <div class="col-lg-6 col-md-10">
            <br />
            <div class="alert alert-success">
                <b>Message : </b> <?= $message_retour['message'] ?>
            </div>
        </div>
        <div class="col-lg-3 col-md-1">&nbsp;</div>
    </div>
<?php } ?>

<h1>Création des produits nécessaires...

    &nbsp;&nbsp;<a class="btn btn-default" href="/jdr/"><span class="glyphicon glyphicon-home"></span></a>

</h1>
<hr/>



<div class="row">
    <!-- On fait appel à des modals pour ajouter les différentes entités (appels redirigés plus bas)-->
    <div class="col-md-12">
        <button class="btn btn-primary" style="margin-right:20px;" onclick="$('#modal_ajout_joueur').modal();">
            <span class="glyphicon glyphicon-plus"></span>
            &nbsp;&nbsp;Ajouter un produit dans la liste
        </button>
        <button class="btn btn-primary" style="margin-right:20px;" onclick="$('#modal_ajout_monstre').modal();">
            <span class="glyphicon glyphicon-plus"></span>
            &nbsp;&nbsp;Ajouter un produit <!--au bestiaire-->
        </button>

    </div>
</div>

<div class="row">

<div class="col-md-12">

<div class="col-md-6">
    <h2>Affichage des <!--joueurs--></h2>
    <hr/>

    <?php

    // S'il y a bien des enregistrements

    if(isset($lesJoueurs)&& !empty($lesJoueurs)){

        ?>


        <form method="POST" action="">
            <div class="row">
                <div class="col-md-10 form-inline">
                    <h3 style="display:inline-block">

                        <button class="btn btn-success" type="submit">
                            <span class="glyphicon glyphicon-ok"></span>
                            &nbsp;&nbsp;Enregistrer les modifications
                        </button>
                    </h3>



                </div>
            </div>
            <br />
            <div class="row">
                <div class="col-md-12">
                    <div id="joueurs-container" style="overflow-y:auto;">
                        <table class="table table-striped table-bordered table-condensed">
                            <thead>
                            <tr style="background-color:#B4AF91;">
                                <th>Pseudo</th>
                                <th>Vie max</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php



                            foreach ($lesJoueurs as $unJoueur) {


                                echo '<tr>';

                                // On envoie les attributs nommés pour le POST


                                echo '    <td><input class="form-control" type="text" name="' . $unJoueur->getId() . '@pseudo' . '" value="' . $unJoueur->getPseudo(). '" />    </td>';
                                echo '    <td><input class="form-control" type="number" min="1" name="' . $unJoueur->getId() . '@vie' . '" value="' . $unJoueur->getVie(). '" />    </td>';




                                // Renvoie à la suppression de joueur
                                ?>

                                <td>
                                    <button class="btn btn-danger" id="supprimer_joueur" name="supprimer_joueur" type="submit"  value="<?php echo $unJoueur->getId();?>" onclick="return supprimerJoueur();">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </button>
                                </td>
                                </tr>
                            <?php




                            }



                            ?>
                            </tbody>
                        </table>


                    </div>
                    <input type="hidden" name="action" value="updateJoueur" />
                </div>
            </div>
        </form>




    <?php
    }

    else{
        echo 'Aucun joueur à afficher ! ';
    }

    ?>
</div>





<div class="col-md-6">
    <h2>Affichage des <!--monstres--></h2>
    <hr/>

    <?php

    // S'il y a bien des enregistrements
    if(isset($lesMonstres) && !empty($lesMonstres)){

        ?>

        <form method="POST" action="">
            <div class="row">
                <div class="col-md-10 form-inline">
                    <h3 style="display:inline-block">

                        <button class="btn btn-success" type="submit">
                            <span class="glyphicon glyphicon-ok"></span>
                            &nbsp;&nbsp;Enregistrer les modifications
                        </button>
                    </h3>



                </div>
            </div>
            <br />
            <div class="row">
                <div class="col-md-12">
                    <div id="monstres-container" style="overflow-y:auto;">
                        <table class="table table-striped table-bordered table-condensed">
                            <thead>
                            <tr style="background-color:#B4AF91;">
                                <th>Nom</th>
                                <th>Espèce</th>
                                <th>Vie max</th>

                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php



                            foreach ($lesMonstres as $unMonstre) {


                                echo '<tr>';
                                echo '    <td><input class="form-control" type="text" name="' . $unMonstre->getId() . '@nom' . '" value="' . $unMonstre->getNom(). '" />    </td>';
                                echo '    <td><input class="form-control" type="text" name="' . $unMonstre->getId() . '@espece' . '" value="' . $unMonstre->getEspece(). '" />    </td>';
                                echo '    <td><input class="form-control" type="number" min="1" name="' . $unMonstre->getId() . '@vie' . '" value="' . $unMonstre->getVie(). '" />    </td>';


                                // Renvoie à la suppression de monstre
                                ?>

                                <td>
                                    <button class="btn btn-danger" id="supprimer_monstre" name="supprimer_monstre" type="submit"  value="<?php echo $unMonstre->getId();?>" onclick="return supprimerMonstre();">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </button>
                                </td>
                                </tr>


                            <?php

                            }


                            ?>
                            </tbody>
                        </table>


                    </div>
                    <input type="hidden" name="action" value="updateMonstre" />
                </div>
            </div>
        </form>


    <?php
    }

    else{

        // TODO changer
        echo 'Aucun produit à afficher !';

    }

    ?>
</div>

</div>
</div>
</div>


<!-- debut modal ajout joueur -->
<div class="modal fade" id="modal_ajout_joueur" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ajouter un nouveau <!--joueur--></h4>
            </div>
            <div class="modal-body">
                <form id="form_ajout_joueur" method="POST" action="">
                    <div class="input-group">
                        <label for="joueur_pseudo" class="input-group-addon">Pseudo : </label>
                        <input class="form-control" type="text" name="joueur_pseudo" id="joueur_pseudo" value="" placeholder="Exemple : Jambon..."/>
                    </div>
                    <br />
                    <div class="input-group">
                        <label for="joueur_vie" class="input-group-addon">Vie</label>
                        <input class="form-control" type="number" name="joueur_vie" id="joueur_vie" value="" min="1"/>
                    </div>
                    <hr />
                    <button class="btn btn-success" type="submit" name="quoi" value="ajout_joueur" onclick="return ajouterJoueur();">
                        <span class="glyphicon glyphicon-ok"></span>
                        &nbsp;&nbsp;Enregistrer le <!--joueur-->
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- debut modal ajout monstre -->
<div class="modal fade" id="modal_ajout_monstre" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ajouter un <!-- nouveau monstre--></h4>
            </div>
            <div class="modal-body">
                <form id="form_ajout_monstre" method="POST" action="">
                    <div class="input-group">
                        <label for="monstre_nom" class="input-group-addon">Nom du monstre : </label>
                        <input class="form-control" type="text" name="monstre_nom" id="monstre_nom" value="" placeholder="Exemple : Sbire 1..."/>
                    </div>
                    <div class="input-group">
                        <label for="monstre_espece" class="input-group-addon">Espèce du monstre : </label>
                        <input class="form-control" type="text" name="monstre_espece" id="monstre_espece" value="" placeholder="Exemple : Gobelin..."/>
                    </div>


                    <br />
                    <div class="input-group">
                        <label for="monstre_vie" class="input-group-addon">Vie</label>
                        <input class="form-control" type="number" name="monstre_vie" id="monstre_vie" value="" min="1"/>
                    </div>
                    <hr />
                    <button class="btn btn-success" type="submit" name="quoi" value="ajout_monstre" onclick="return ajouterMonstre();">
                        <span class="glyphicon glyphicon-ok"></span>
                        &nbsp;&nbsp;Enregistrer le <!--monstre-->
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>



<script src="pages/lib/jquery/jquery.min.js"></script>
<script src="pages/lib/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
    /**
     * Ajout d'un nouveau monstre : vérif
     */
    function ajouterMonstre() {
        var nom = $('#monstre_nom').val();
        var espece = $('#monstre_espece').val();

        var vie = $('#monstre_vie').val();
        if(nom == "") { alert('ERREUR : veuillez renseigner le nom du monstre !'); return false; }
        if(espece == "") { alert('ERREUR : veuillez renseigner l\'espece du monstre !'); return false; }

        if(vie == "") { alert('ERREUR : veuillez renseigner des points de vie !'); return false; }
        return true;

    }

    /**
     * Ajout d'un nouveau joueur : vérif
     */
    function ajouterJoueur() {
        var pseudo = $('#joueur_pseudo').val();
        var vie = $('#joueur_vie').val();
        if(pseudo == "") { alert('ERREUR : veuillez renseigner le pseudo !'); return false; }
        if(vie == "") { alert('ERREUR : veuillez renseigner des points de vie !'); return false; }

        return true;
    }

    /**
     * Suppression d'un  joueur : vérif
     */
    function supprimerJoueur() {


        if(confirm("Souhaitez-vous vraiment supprimer ce joueur ? Cette action est irréversible.")) {


            return true;

        }

    }

    /**
     * Suppression d'un  monstre : vérif
     */
    function supprimerMonstre() {


        if(confirm("Souhaitez-vous vraiment supprimer ce monstre ? Cette action est irréversible.")) {


            return true;

        }

    }


</script>


</body>

