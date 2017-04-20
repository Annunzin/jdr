<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>JDR - Lancement</title>
    <link rel="stylesheet" href="pages/lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="pages/style/style.css">
</head>
<body>



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

    <div class="container">





        <h1>Lancement <!-- de la partie-->

            &nbsp;&nbsp;<a class="btn btn-default" href="/jdr/"><span class="glyphicon glyphicon-home"></span></a>


        </h1>
        <hr/>


        <?php
        // S'il y a bien des enregistrements
        if(isset($lesParties) && !empty($lesParties)){


        ?>

            <form method="POST" action="">

                <div class="row">
                    <div class="col-md-12">
                        <div id="parties-container" style="overflow-y:auto;">
                            <table class="table table-striped table-bordered table-condensed">
                                <thead>
                                <tr style="background-color:#B4AF91;">
                                    <th>Numéro</th>
                                    <th>Nom du joueur</th>
                                    <th>Nb de monstres restants</th>

                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php



                                foreach ($lesParties as $unePartie) {


                                    echo '<tr>';
                                    echo '    <td><input class="form-control" readonly="readonly" type="text" name="' . $unePartie->getId() . '@id' . '" value="' . $unePartie->getId(). '" />    </td>';
                                    echo '    <td><input readonly="readonly" class="form-control" type="text" name="' . $unePartie->getJoueurPseudo(). '" value="' . $unePartie->getJoueurPseudo(). '" />    </td>';
                                    echo '    <td><input readonly="readonly" class="form-control" type="text" min="1" name="' . $unePartie->getNbMonstre() . '" value="' . $unePartie->getNbMonstre(). '" />    </td>';


                                    // Lance la partie
                                    ?>

                                    <td>
                                        <button class="btn btn-success" id="lancer_partie" name="lancer_partie" type="submit"  value="<?php echo $unePartie->getId();?>" onclick="return lancerPartie();">
                                            Lancer la partie !
                                        </button>
                                    </td>
                                    </tr>


                                <?php

                                }


                                ?>
                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
            </form>

        <?php


        }



        else{

            echo 'Il n\'y a aucune partie en cours ! Allez en créer une nouvelle.';
        }
        ?>

    </div>


<script src="pages/lib/jquery/jquery.min.js"></script>
<script src="pages/lib/bootstrap/js/bootstrap.min.js"></script>


<script type="text/javascript">

    /**
    * Confirmer lancement partie
    */
    function lancerPartie() {


        if(confirm("Souhaitez-vous vraiment lancer cette partie ?")) {


            return true;

        }

    }

</script>


</body>
