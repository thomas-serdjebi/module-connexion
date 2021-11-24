<?php

    session_start();

    require('connexiondb.php');

    
    if(isset($_POST['connexion'])){

        // SECURITE //

        $login = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['login']));
        $password = mysqli_real_escape_string($mysqli,htmlspecialchars(md5($_POST['password'])));
        
        // VERIF SI CHAMPS REMPLIS 

        if (null ==! $login) {
            $err_login ="Veuillez renseigner votre login.";
            $validation = false;
        }

        if (null ==! (md5($password))) {
            $err_password = "Veuillez renseigner votre mot de passe.";
            $validation = false;
        }

        // AUTHENTIFICATION

        if(isset($login) && isset($password)) {

            $requete = mysqli_query($mysqli, "SELECT * FROM utilisateurs WHERE login = '".$login."' AND password = '".$password."'") ;

            $mysqli_result = mysqli_num_rows($requete);

            if ($mysqli_result == 0) {

                $resultat = "Le pseudo ou le mot de passe est incorrect.";

            }

            else {

                $_SESSION['login'] = $login ;

                $resultat = "Vous êtes connecté. ";

                $afficherformulaire = 0;

                if (($_SESSION['login']) == 'admin' ) {

                    header ('Location: http://localhost/module-connexion/php/admin.php' );

                }

                else  {

                    header ('Location: http://localhost/module-connexion/php/profil.php' );
                }


                



            }  
        }

    }

?>




<html lang="fr">

    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="/module-connexion/style/mainforms.css">
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

            <div class="reglesform"> Veuillez vous connecter pour accéder aux informations de votre profil. </div>

            <section>

                    <form method="post" action="connexion.php" class="styleform">
                            <div class='underform'><?php if(isset($err_login)) { echo $err_login ; } ?></div>
                            <div><input type="text" name="login" placeholder="login" class="inputbasic"></div>
                        
                            <div class='underform'><?php if(isset($err_password)) { echo $err_password ; } ?></div>
                            <div><input type="password" name="password" placeholder="password" class="inputbasic"></div>
                        </div>

                        <input type="submit" name="connexion" value="Connexion" class="inputbasic">

                        <br>

                        <div class="reglesform"> Nouveau ici ? Inscrivez vous ci dessous !<br>
                        <a href="/module-connexion/php/inscription.php"><input type="button" class="inputbasic" value="Inscription"></a>
                        </div>

                    </form>



            </section>

            <section class="underform">
 
                <div><?php if(isset($resultat)) { echo $resultat ; } ?></div>
                
                
                 
            </section>
            <!-- RAJOUTER VOUS ETES NOUVEAU ICI ? SINSCRIRE -->



  





           




        </main>


            
        <?php require('footer.php'); ?> <!--LINK VERS LE FOOTER -->



    </body>

</html>