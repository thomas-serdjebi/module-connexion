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

   // création du tableau associatif avec mysqli fetch assoc

   $infos = mysqli_fetch_assoc($requete) ;

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




        </main>


            
        <?php require('footer.php'); ?> <!--LINK VERS LE FOOTER -->



    </body>

</html>







    

    



?>

