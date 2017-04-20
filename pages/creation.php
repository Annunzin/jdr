<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>JDR - Creation</title>
    <link rel="stylesheet" href="pages/lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="pages/style/style.css">
</head>
<body>

<div class="container">



    <!-- Renvoie le tableau de message de retour s'il y'en a un -->
    <?php if(isset($message_retour) && !$message_retour['erreur']) { ?>
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

    <!-- Renvoie le tableau de message de retour s'il y'en a un -->
    <?php if(isset($message_retour) && $message_retour['erreur']) { ?>
        <div class="row">
            <div class="col-lg-3 col-md-1">&nbsp;</div>
            <div class="col-lg-6 col-md-10">
                <br />
                <div class="alert alert-danger">
                    <b>Message : </b> <?= $message_retour['message'] ?>
                </div>
            </div>
            <div class="col-lg-3 col-md-1">&nbsp;</div>
        </div>
    <?php } ?>



    <h1>Création <!-- de la partie-->

        &nbsp;&nbsp;<a class="btn btn-default" href="/jdr/"><span class="glyphicon glyphicon-home"></span></a>

    </h1>
    <hr/>

    <div class="row">


        <form id="form_creation_partie" method="POST" action="">



            <label for="joueur_choisi" class="input-group-addon">Joueur : </label>

            <select name="joueur_choisi" class="form-control">
                <?php
                if(isset($lesJoueurs)&&!empty($lesJoueurs)){
                    foreach($lesJoueurs as $unJoueur) {
                        echo '<option value="' . $unJoueur->getId(). '" >' . $unJoueur->getPseudo() . '</option>';
                    }

                }
                else{
                    echo 'Allez créer un joueur avant de lancer une partie ! ';
                }

                ?>
            </select>


            <label for="monstre_choisi[]" class="input-group-addon">Monstre : </label>

            <div id="champs">
                <select  name="monstre_choisi[]" multiple class="form-control">


                    <?php
                    if(isset($lesMonstres)&&!empty($lesMonstres)){

                        foreach($lesMonstres as $unMonstre) {
                            echo '<option value="' . $unMonstre->getId(). '" >' . $unMonstre->getNom() . ' / '. $unMonstre->getEspece(). '</option>';
                        }

                    }
                    else{
                        echo 'Allez créer un monstre avant de lancer une partie ! ';
                    }

                    ?>

                </select>
            </div>


            <br />

            <hr />
            <button class="btn btn-success" type="submit" name="quoi" value="ajout_joueur" onclick="return ajouterJoueur();">
                <span class="glyphicon glyphicon-ok"></span>
                &nbsp;&nbsp;Enregistrer le <!--joueur-->
            </button>
        </form>

    </div>




</div>

<script src="pages/lib/jquery/jquery.min.js"></script>
<script src="pages/lib/bootstrap/js/bootstrap.min.js"></script>




</body>
