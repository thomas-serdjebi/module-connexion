<?php

    session_start();

    require('connexiondb.php');

    $afficherformulaire = 1;

    if(isset($_POST['connexion'])){

        // SECURITE //

        $login = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['login']));
        $password = mysqli_real_escape_string($mysqli,htmlspecialchars(md5($_POST['password'])));

        // VERIF SI CHAMPS REMPLIS 

        if (empty($login)) {
            $err_login ="Veuillez renseigner votre login.";
        }

        if (empty($password)) {
            $err_password = "Veuillez renseigner votre mot de passe.";
        }

        // AUTHENTIFICATION

        else {

            $requete = mysqli_query($mysqli, "SELECT * FROM utilisateurs WHERE login = '".$login."' AND password = '".$password."'") ;

            $mysqli_result = mysqli_num_rows($requete);

            if ($mysqli_result == 0) {

                $resultat = "Le pseudo ou le mot de passe est incorrect.";

            }

            else {

                $_SESSION['login'] = $login ;
                header ('Location: http://localhost/module-connexion/php/profil.php' );

                $resultat = "Vous êtes connecté. ";

                $afficherformulaire = 0;

            } 


           
        }


    
    }







?>




<html lang="fr">

    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="/module-connexion/style/index.css">
        <link rel="stylesheet" href="/module-connexion/style/header.css">
        <link rel="stylesheet" href="/module-connexion/style/footer.css">
        <title>Connexion</title>
    </head>

    <body>

        <header>
            <?php require('header.php'); ?> <!-- LINK AVEC LE HEADER -->
        </header>

        <main>

    

            <h1>Connexion</h1>

            <p> Veuillez vous connecter pour accéder aux informations de votre profil. <p>

            <section>

                <?php if($afficherformulaire == 1) { ?>

                    <form method="post">
                        <div>
                            <input type="text" name="login" placeholder="login">
                        </div>
                        <div>
                            <input type="password" name="password" placeholder="password">
                        </div>

                        <input type="submit" name="connexion" value="Connexion">
                    </form>
                <?php } ?>


            </section>

            <section class="underform">
 
                <div><?php if(isset($resultat)) { echo $resultat ; } ?></div>
                <div><?php if(isset($err_login)) { echo $err_login ; } ?></div>
                <div><?php if(isset($err_password)) { echo $err_password ; } ?></div>
                 
            </section>
            <!-- RAJOUTER VOUS ETES NOUVEAU ICI ? SINSCRIRE -->

  





           




        </main>


            
        <?php require('footer.php'); ?> <!--LINK VERS LE FOOTER -->



    </body>

</html>