<?php

?>

<html lang="fr">

    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="./style/index.css">
        <link rel="stylesheet" href="./style/header.css">
        <link rel="stylesheet" href="./style/footer.css">
        <title>Accueil</title>
    </head>

    <body>

        

        <header>
            <?php require('php/headerindex.php'); ?> <!-- LINK AVEC LE HEADER -->
        </header>

        <main>

            <div class="indexcontent">
                <div class="indextitres">
                    <h1> ART CONNEXION </h1>
                </div>


                <div class="indexparagraphes">
                    <p> 
                        Vous souhaitez faire partie d'une communauté artistique du web ?
                    <p>

                    <p>N'attendez plus et inscrivez vous !</p></br>
                    <p>
                        Créez un compte dans l'onglet <a class="bodyliens" href="php/inscription.php">Inscription</a>.</br>
                        Accédez à votre compte dans l'onglet connexion <a class="bodyliens" href="php/inscription.php">Connexion</a>.</br>
                        Modifiez votre profil au besoin dans l'onglet <a class="bodyliens" href="php/inscription.php">Profil</a>.</br>
                        Si vous êtes administrateur, accédez à l'ensemble des informations utilisateurs dans l'onglet <a class="bodyliens" href="php/admin.php">Admin</a>.</br>
                    </p>
                </div>


            </div>

        </main>


            
        <?php require('php/footerindex.php'); ?> <!--LINK VERS LE FOOTER -->



    </body>

</html>


