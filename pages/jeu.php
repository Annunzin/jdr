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
                echo '    Dégâts de base :'.$joueur->getDegatBase();
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


            <div id="menuMonstre" class="col-md-offset-1 col-md-8 col-lg-8 col-sm-8">

                <h3>

                    Espèce :
                    <?php echo $monstre_actuel->getEspece(); ?>
                </h3>

                <?php

                echo '    <hr/>';
                echo '    <br/>';
                echo '    Nom :'.$monstre_actuel->getNom();
                echo '    <br/>';
                echo '    Dégâts de base :'.$monstre_actuel->getDegatBase();
                echo '    <br/>';

                echo '    <p id="affichage_vie_monstre">';
                echo $monstre_actuel->getVie().'/'.$monstre_actuel->getVie();
                echo '    </p>';

                echo '    <br/>';

                ?>
                <br/>

                <button class="btn btn-danger" id="attaquer_monstre" name="attaquer_monstre" onclick="attaquerMonstre();">
                    Attaquer !!!
                </button>


            </div>

        </div>




    </div>



<script src="pages/lib/jquery/jquery.min.js"></script>
<script src="pages/lib/bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript">


    // vie_actuelle, pseudo, vie_max, degat_base, vivant, objets

    var joueur = <?php echo json_encode($joueur);?>;


    // nom, espece, id, vie_max, degat_base, vie, vivant, objet
    var monstre_actuel = <?php echo json_encode($monstre_actuel);?>;



    /**
     * test perte pv
     */
    function perdrePv() {


        joueur.vie_actuelle = joueur.vie_actuelle-1;

        document.getElementById("affichage_vie").innerHTML =joueur.vie_actuelle+'/'+joueur.vie_max;

    }




    /**
     * Fonction d'attaque du monstre
     */
    function attaquerMonstre() {


        joueur.vie_actuelle = joueur.vie_actuelle-monstre_actuel.degat_base;

        // On save si le joueur meurt
        if(joueur.vie_actuelle <=0){
            joueur.vivant=false;
            $('#sauvegarder_partie').click();
        }
        monstre_actuel.vie = monstre_actuel.vie - joueur.degat_base;


        // On save si le monstre meurt
        if(monstre_actuel.vie <=0){
            monstre_actuel.vivant=false;
            $('#sauvegarder_partie').click();
        }



        document.getElementById("affichage_vie").innerHTML =joueur.vie_actuelle+'/'+joueur.vie_max;
        document.getElementById("affichage_vie_monstre").innerHTML =monstre_actuel.vie+'/'+monstre_actuel.vie_max;

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


        // cas où le joueur est mort
        if(joueur.vie_actuelle <=0){


            var form = $('<form action="' + url + '" method="post">' +
            '<input  type="text" name="joueur_vivant" value="'+joueur.vivant+' " />' +
            '</form>');
            $('body').append(form);
            form.submit();


        }


        // cas où le monstre est mort

        else if(monstre_actuel.vie <=0){
            var form = $('<form action="' + url + '" method="post">' +
            '<input  type="hidden" name="monstre_vivant" value="'+monstre_actuel.vivant+' " />' +
            '<input  type="hidden" name="vie_actuelle" value="'+joueur.vie_actuelle+' " />' +

            '</form>');
            $('body').append(form);
            form.submit();
        }

        else{


            var form = $('<form action="' + url + '" method="post">' +
            '<input  type="hidden" name="vie_actuelle" value="'+joueur.vie_actuelle+' " />' +
            '</form>');
            $('body').append(form);
            form.submit();


        }




    });


</script>
</body>
