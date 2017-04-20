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
                echo '    <p id="affichage_vie">';
                echo $joueur->getVieActuelle().'/'.$joueur->getVie();
                echo '    </p>';

                echo '    <br/>';
                echo 'Restants : '.$unePartie->getNbMonstre();

                ?>
                <br/>

                <button class="btn btn-danger" id="perdre_pv" name="perdre_pv" onclick="perdrePv();">
                    <span class="glyphicon glyphicon-remove"></span>
                </button>

                <button class="btn btn-success" id="sauvegarder_partie" name="sauvegarder_partie">
                    <span class="glyphicon glyphicon-save"></span>
                </button>


            </div>



        </div>




    </div>



<script src="pages/lib/jquery/jquery.min.js"></script>
<script src="pages/lib/bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript">


    // vie_actuelle, pseudo, vie_max, vivant, objets

    var joueur = <?php echo json_encode($joueur);?>;


    /**
     * test perte pv
     */
    function perdrePv() {


        joueur.vie_actuelle = joueur.vie_actuelle-1;

        document.getElementById("affichage_vie").innerHTML =joueur.vie_actuelle+'/'+joueur.vie_max;

    }


    function $_GET(param) {
        var vars = {};
        window.location.href.replace( location.hash, '' ).replace(
            /[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
            function( m, key, value ) { // callback
                vars[key] = value !== undefined ? value : '';
            }
        );

        if ( param ) {
            return vars[param] ? vars[param] : null;
        }
        return vars;
    }

    $("#sauvegarder_partie").on("click",function(){




        var param_partie = $_GET('partie');

        // Récupération des valeurs


        var url = 'jeu&partie='+param_partie;


        var data =  'vie_actuelle='+ joueur.vie_actuelle;

        var form = $('<form action="' + url + '" method="post">' +
        '<input  type="hidden" name="vie_actuelle" value="'+joueur.vie_actuelle+' " />' +
        '</form>');
        $('body').append(form);
        form.submit();




    });


</script>
</body>
