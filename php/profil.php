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

   if(!empty($_POST)) {
    extract($_POST);
    $valid =(boolean) true;
   

   if (isset($_POST['modifier'])) {

        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $password = $_POST['password'];

        $login = (String) trim($login);
        $prenom = (String) trim($prenom);
        $nom = (String) trim($nom);
        $password = (String) trim($password);

        $testlogin = mysqli_query($mysqli, "SELECT * FROM utilisateurs WHERE login='".$login."'");

        $mysqli_result = mysqli_num_rows($testlogin) ;

        // TEST LOGIN => CARACTERES, LONGUEUR, SI DEJA UTILISE ?

        if(empty($login)) {
            $err_login = "Veuillez renseigner le login !";
            $valid= false;

        }

        if (isset($login)) {
            if(!preg_match("#^[a-z0-9]+$#",$login)) {
            $err_login = "Le login doit être renseigné uniquement en lettres minuscules, sans accents, sans caractères spéciaux.";
            $valid= false;
            }

            elseif(strlen($login)>12) {             
                $err_login= "Le login est trop long, il dépasse 12 caractères.";
                $valid= false;
            }

            elseif (($mysqli_result) ==1) { //on vérifie que ce pseudo n'est pas déjà utilisé par un autre membre
                $err_login = "Ce login est déjà utilisé.";
                $valid= false;
            }
        }

        // TEST PRENOM => CHAMP VIDE, CARACTERES ?
        if (isset($prenom)) {
            if(!preg_match("#^[a-z]+$#",$prenom)) {
                $err_prenom = "Le prénom doit être renseigné uniquement en lettres minuscules et sans accents.";
                $valid= false;
            }
        }
        
        // TEST NOM => CHAMP VIDE, CARACTERES ?

        if (isset($nom)) {
            if(!preg_match("#^[a-z]+$#",$nom)) {
            $err_nom = "Le nom doit être renseigné uniquement en lettres minuscules et sans accents.";
            $valid= false;
            }
        }

        // TEST MDP => CHAMP VIDE ?

        if(empty($password)) {
        $err_password = "Veuillez renseigner votre mot de passe !";
        $valid= false;
        }



        if($valid) {

            mysqli_select_db ($mysqli, 'moduleconnexion') ;

            // REQUETE MODIFICATION 

            $sql = "UPDATE utilisateurs SET 
            login ='".$login."',
            prenom = '".$prenom."',
            nom = '".$nom."',
            password = '".$password."'
            WHERE login='".$login."'";

            if (mysqli_query($mysqli, $sql)) {
    
                $suscribeok = "Vos modifications ont été enregistrées avec succès!";

                $afficherformulaire = 0;

                //REAFFICHAGE AVEC INFOS UPDATE


                $sql = "SELECT * FROM utilisateurs WHERE login = '$login' ";

                // exécution requete
            
               $requete = mysqli_query($mysqli, $sql) ;
            
               // création du tableau associatif avec mysqli fetch array
            
               $infos = mysqli_fetch_array($requete) ;

                $message = "Vos modifications ont été enregistrées avec succès!";
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
                <div><input type="text" name="login" value="<?php echo $infos['login']; ?>"></div>

                <br>

                <div><label for="prenom">Prénom</label></div>
                <div><input type="text" name="prenom" value="<?php echo $infos['prenom']; ?>"></div>

                <br>

                <div><label for="nom">Nom</label></div>
                <div><input type="text" name="nom" value="<?php echo $infos['nom']; ?>"></div>

                <br>

                <div><label for="login">Password</label></div>
                <div><input type="password" name="password" value="<?php $infos['password']; ?>"></div>

                <br>

                <div><input type="submit" name="modifier" value="Enregistrer"></div>
            </section>

            <button type="submit" name="déconnecter" value="Se déconnecter">Se déconnecter</button>

            <section class='underform'> <!-- MODIFICATIONS REUSSIES  -->
                <div>
                    <?php 
                        if (isset($message)) { echo $message ;} 
                    ?>
                </div>
                <div><?php if (isset($err_login)) { echo $err_login ;}?></div>
                <div><?php if (isset($err_prenom)) { echo $err_prenom ;} ?></div>
                <div><?php if (isset($err_nom)) { echo $err_nom ;} ?></div>
                <div><?php if (isset($err_password)) { echo $err_password;}?></div>
                        
                        
                        
                        
                    
                </div>

            </section>


          
                

        </main>


            
        <?php require('footer.php'); ?> <!--LINK VERS LE FOOTER -->



    </body>

</html>



