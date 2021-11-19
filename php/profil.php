<?php

    session_start();

    // si l'utilisateur n'est pas connecté //

    if (!isset($_SESSION['login'])) { 
        header ("Refresh: 5; url=connexion.php");
         // renvoie l'utilisateur automatiquement sur la page de connexion au bout de 5 secondes

        $err_connexion = "Vous devez vous connecter pour accéder à l'onglet profil.";
         //arret de l'exécution du reste de la page

        exit(0);
    }

    $login = $_SESSION['login']  ; // simplification session login

    include_once('connexiondb.php') ;

    // requete sql selection de l'utilisateur

    $sql = "SELECT * FROM utilisateurs WHERE login = '$login' ";

    // exécution requete

   $requete = mysqli_query($mysqli, $sql) ;

   // création du tableau associatif avec mysqli fetch array

   $infos = mysqli_fetch_array($requete) ;

   if (isset($_POST['modifier'])) {

        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $password = $_POST['password'];

        if (isset($login) AND $login!== "") {

            if (isset($prenom) AND $prenom!== "") {

                if (isset($nom) AND $nom!== "") {

                    if (isset($password) AND $password!== "") {

                        // REQUETE MODIFICATION 

                        $sql = "UPDATE utilisateurs SET 
                        login ='".$login."',
                        prenom = '".$prenom."',
                        nom = '".$nom."',
                        password = '".$password."'
                        WHERE login='".$login."'";

                        if (mysqli_query($mysqli, $sql)) {

                            //REAFFICHAGE FORMULAIRE AVEC INFOS UPDATE
                            $sql = "SELECT * FROM utilisateurs WHERE login = '$login' ";
                           $requete = mysqli_query($mysqli, $sql) ;
                           $infos = mysqli_fetch_array($requete) ;
                           $message = "Vos modifications ont été enregistrées avec succès!";
                        }

                    }
                }
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
        <title>Profil</title>
    </head>

    <body>

        <header>
            <?php require('header.php'); ?> <!-- LINK AVEC LE HEADER -->
        </header>

        <main>

    

            <h1>Profil</h1>

            <!-- <section>
                <div> Pour modifier vos informations, <a href="http://localhost/module-connexion/php/profil.php?modifier">Cliquez ici </a>
                    <br>
                </div>

                <div> Pour supprimer votre compte, <a href="http://localhost/module-connexion/php/profil.php?supprimer">Cliquez ici </a>
                    <br>
                </div>

                <div> Pour vous déconnecter, <a href="http://localhost/module-connexion/php/deconnexion.php">Cliquez ici</a>

            </section> -->


            <section>

                
    
                <form action="profil.php" method="post" id="modif_utilisateurs">
                
                <div><label for="login">Login</label></div>
                <div><input type="text" name="login" placeholder="<?php echo $infos['login']; ?>"></div>

                <br>

                <div><label for="prenom">Prénom</label></div>
                <div><input type="text" name="prenom" value="<?php echo $infos['prenom']; ?>"></div>

                <br>

                <div><label for="nom">Nom</label></div>
                <div><input type="text" name="nom" value="<?php echo $infos['nom']; ?>"></div>

                <br>

                <div><label for="login">Password</label></div>
                <div><input type="password" name="password" value="<?php echo md5($infos['password']); ?>"></div>

                <br>

                <div><input type="submit" name="modifier" value="modifier"></div>
            </section>

            <section class='underform'> <!-- MODIFICATIONS REUSSIES  -->
                <div>
                    <?php 
                        if (isset($message)) { echo $message ;} 
                    ?>
                </div>

            </section>

                

        </main>


            
        <?php require('footer.php'); ?> <!--LINK VERS LE FOOTER -->



    </body>

</html>



