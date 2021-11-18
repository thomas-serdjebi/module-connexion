<?php

?>

<html lang="fr">

    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style/index.css">
        <link rel="stylesheet" href="style/header.css">
        <link rel="stylesheet" href="style/footer.css">
        <title>Accueil</title>
    </head>

    <body>

        

        <header>
            <?php require('php/header.php'); ?> <!-- LINK AVEC LE HEADER -->
        </header>

        <main>

            <div class="indexcontent">
                <div class="indextitres">
                    <h2> Bienvenue sur le projet </h2>
                    <h1> MODULE CONNEXION </h1>
                </div>


                <div class="indexparagraphes">
                    <p> Ce site WEB est conçu dans le cadre du projet "MODULE CONNEXION",
                        à concevoir dans le cadre de la formation de Développeur Web & Web Mobile,
                        de l'école du digital La Plateforme_.
                    </p>

                    <p> Sur ce site Web vous pourrez :
                        <ul>
                            <li> Créer un compte dans l'onglet inscription. </li>
                            <li> Accéder à votre compte lorsque celui ci sera créé dans l'onglet connexion. </li>
                            <li> Modifier votre profil au besoin dans l'onglet profil.</li>
                            <li> Accéder à l'ensemble des informations utilisateurs pour l'administrateur dans l'onglet admin.</li>
                        </ul>
                    </p>
                </div>


            </div>

        </main>


            
        <?php require('php/footer.php'); ?> <!--LINK VERS LE FOOTER -->



    </body>

</html>


