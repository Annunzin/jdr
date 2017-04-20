<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>JDR - Jeu</title>
    <link rel="stylesheet" href="pages/lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="pages/style/style.css">
</head>
<body>



    <div class="container">






        <h1><!-- Partie -->en cours...

            <!-- Faire un retour avec sauvegarde et non un retour comme ça-->
            &nbsp;&nbsp;<a class="btn btn-default" href="/jdr/"><span class="glyphicon glyphicon-home"></span></a>


        </h1>
        <hr/>


        <div class="row">

            <div id="menuJoueur" class="col-md-3 col-lg-3 col-sm-3">

                <h3>

                    <?php echo $joueur->getPseudo();
                    ?>
                </h3>

                <?php

                echo '    <hr/>';
                echo '    <br/>';
                echo $joueur->getVieActuelle().'/'.$joueur->getVie();
                echo '    <br/>';
                echo 'Restants : '.$unePartie->getNbMonstre();

                ?>
                <br/>



            </div>



        </div>


    </div>



<script src="pages/lib/jquery/jquery.min.js"></script>
<script src="pages/lib/bootstrap/js/bootstrap.min.js"></script>
</body>
