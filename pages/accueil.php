<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>JDR - test</title>
    <link rel="stylesheet" href="pages/lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="pages/style/style.css">
</head>
<body>

    <div class="container">





        <h1>Accueil</h1>
        <hr/>


        <div class="row" style="width:100%;margin:auto;">
            <div class=" col-sm-offset-3 col-lg-offset-3 col-md-offset-3 col-sm-6 col-md-6 col-lg-6">
                <div style="height:150px;" class="bloc-vue" onclick="window.location.href='/jdr/lancement';">
                    <h3>
                        <!-- TODO : changer car c'est moche -->
                        <span class="glyphicon glyphicon-pushpin"></span>
                        Lancement <!-- d'une nouvelle partie -->
                    </h3>
                    <hr />
                    <p>Le choix d'une partie sera possible avec un récapitulatif de ce qu'il y a dedans.</p>

                </div>
            </div>



        </div>

        <div class="row" style="width:100%;margin:auto;">
            <div class=" col-sm-6 col-md-6 col-lg-6">
                <div style="height:200px;" class="bloc-vue" onclick="window.location.href='/jdr/creation';">
                    <h3>
                        <!-- TODO : changer car c'est moche -->
                        <span class="glyphicon glyphicon-pushpin"></span>
                        Création <!-- d'une nouvelle partie -->
                    </h3>
                    <hr />
                    <p>La création <!-- d'une partie--> sera possible.</p>

                </div>
            </div>


        <div class=" col-sm-6 col-md-6 col-lg-6">
            <div style="height:200px;" class="bloc-vue" onclick="window.location.href='/jdr/parametres';">
                <h3>
                    <span class="glyphicon glyphicon-pushpin"></span>
                    Paramètres
                </h3>
                <hr />
                <p>Les choses suivantes pourront être modifiées :</p>
                <ul>
                    <li>Joueurs</li>
                    <li>Monstres</li>
                </ul>
            </div>
        </div>
    </div>



    <script src="pages/lib/jquery/jquery.min.js"></script>
    <script src="pages/lib/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">





    </script>


</body>
