<?php

    session_start();

    if (!isset($_SESSION['login'])) {  
        header("Refresh: 1; url=connexion.php");
        // renvoie l'utilisateur automatiquement sur la page de connexion au bout de 5 secondes

        $err_connexion = "Vous devez vous connecter pour accéder à l'onglet profil.";
        //arret de l'exécution du reste de la page

        exit(0);


    }

    if (isset($_POST['deconnexion'])) {

        session_destroy();

        header('Location: http://localhost/module-connexion/php/connexion.php');
    }

    require('connexiondb.php') ;

    $formulaireinfos = 1 ; // AFFICHER DOFFICE LE FORMULAIRE DE MODIFICATIONS DES INFOS
    $formulairemdp = 0 ; // NE PAS AFFICHER DOFFICE LE FORMULAIRE DE MODIFICATION DU MDP

    // requete sql selection de l'utilisateur

    $sql = "SELECT * FROM utilisateurs WHERE login = '".$_SESSION['login']."' ";

    // exécution requete

   $requete = mysqli_query($mysqli, $sql) ;

   // création du tableau associatif avec mysqli fetch array

   $infos = mysqli_fetch_array($requete) ;

   
       
   

    if (isset($_POST['modifier'])) {
        $login= $_POST["login"];
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $valid1 =(boolean) true;

        $testlogin = mysqli_query($mysqli, "SELECT * FROM utilisateurs WHERE login='".$login."'");

        $mysqli_resultlogin = mysqli_num_rows($testlogin) ;

        // TEST LOGIN => CARACTERES, LONGUEUR, SI DEJA UTILISE ?

        if ($login != $_SESSION['login']) { 

            if (($mysqli_resultlogin) ==1) { //on vérifie que ce pseudo n'est pas déjà utilisé par un autre membre
                $err_login = "Ce login est déjà utilisé.";
                $valid1= false;
            }
        }


        if (!empty($login)) {
            if(!preg_match("#^[a-z0-9]+$#",$login)) {
            $err_login = "Le login doit être renseigné uniquement en lettres minuscules, ou chiffres sans accents, sans caractères spéciaux.";
            $valid1= false;
            }

            elseif(strlen($login)>12) {             
                $err_login= "Le login est trop long, il dépasse 12 caractères.";
                $valid1= false;
            }
        }

        // TEST PRENOM => CHAMP VIDE, CARACTERES ?
        if (!empty($prenom)) {
            if(!preg_match("#^[a-z]+$#",$prenom)) {
                $err_prenom = "Le prénom doit être renseigné uniquement en lettres minuscules et sans accents.";
                $valid1= false;
            }
        }
        
        // TEST NOM => CHAMP VIDE, CARACTERES ?

        if (!empty($nom)) {
            if(!preg_match("#^[a-z]+$#",$nom)) {
            $err_nom = "Le nom doit être renseigné uniquement en lettres minuscules et sans accents.";
            $valid1= false;
            }
        }

        // TESTS DU MDP SI VIDE PUIS SI CORRECT POUR CONFIRMATION

        $requetemdp = mysqli_query($mysqli, "SELECT * FROM utilisateurs WHERE password = '".md5($_POST['password'])."'") ; // REQUETE SQL SI MDP OK

        $mysqli_resultmdp = mysqli_num_rows($requetemdp);  // COMPTE LE NOMBRE DE LIGNES CORRESPONDANTES

        var_dump($mysqli_resultmdp);

        // TEST SI VIDE

        if (empty($_POST['password'])) {
            $err_password = "Veuillez renseigner votre mot de passe.";
            $valid1 = false;
        }

        // TEST CONFIRMATION MODIFICATIONS AVEC MDP



        elseif ($mysqli_resultmdp == 0) {
            
            $err_password = "Le mot de passe est incorrect.";
            $valid1 = false;

        }



        else {

            mysqli_select_db ($mysqli, 'moduleconnexion') ;

            // REQUETE MODIFICATION PAR CHAMP

            $sql = "UPDATE utilisateurs SET login ='".$login."', prenom ='".$prenom."', nom ='".$nom."' WHERE login = '".$_SESSION['login']."'";

            if (mysqli_query($mysqli, $sql) ) {
    
                $message = "Vos modifications ont été enregistrées avec succès!";

                $formulaireinfos = 0;

                

            }
        }
    }


    // FORMULAIRE CHANGEMENT MOT DE PASSE 
    if(isset($_POST['modifiermdp'])) {

        $formulairemdp = 1 ; // AFFICHE FORMULAIRE MDP
        $formulaireinfos = 0; //CACHE FORMULAIRE INFO
    }


    if(isset($_POST['modifiermdp1'])) {
            $valid2 =(boolean) true; // PERMET DE LANCER LA MODIF

            $formulairemdp = 1 ; // AFFICHE FORMULAIRE MDP
            $formulaireinfos = 0; //CACHE FORMULAIRE INFO
            $actualpassword = $_POST['actualpassword'];
            $newpassword = $_POST['newpassword'];
            $confirmpassword = $_POST['confirmpassword'];

            $requete = mysqli_query($mysqli, "SELECT * FROM utilisateurs WHERE password = '".md5($actualpassword)."'") ; // REQUETE TEST MDP ACTUEL


            $mysqli_result = mysqli_num_rows($requete); // comptage des ligne de résultat de requete

            if(empty($actualpassword)) {

                $err_password = "Veuillez renseigner votre mot de passe actuel.";
                $valid2 = false;
            }

            elseif ($mysqli_result == 0) {

                $err_password = "Le mot de passe actuel est incorrect.";
                $valid2 = false;
            }


            elseif(empty($newpassword)) {

                $err_password = "Veuillez renseigner votre nouveau mot de passe.";
                $valid2 = false;
            }

            elseif(empty($confirmpassword)) {

                $err_password = "Veuillez confirmer votre nouveau mot de passe.";
                $valid2 = false;
            }
            
            elseif ($newpassword != $confirmpassword) {
                $err_password = "Les nouveaux mot de passes ne correspondent pas. Veuillez réessayer.";
                $valid2 = false;      
            }

            else {
                
                $modifmdp = mysqli_query($mysqli, "UPDATE utilisateurs SET password = '".md5($newpassword)."'");

    
                $message = "Votre mot de passe a été modifié avec succès !";
                    
                $formulaireinfos == 0;
                    
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




            <section>

                <?php if ($formulaireinfos ==1 ) { ?>

                <form action="profil.php" method="post" id="modif_utilisateurs">
                
                <div><label for="login">Login</label></div>
                <br>
                <div><input type="text" name="login" value="<?php echo $infos['login']; ?>"></div>

                <br>
                <br>

                <div><label for="prenom">Prénom</label></div>
                <br>
                <div><input type="text" name="prenom" value="<?php echo $infos['prenom']; ?>"></div>

                <br>
                <br>

                <div><label for="nom">Nom</label></div>
                <br>
                <div><input type="text" name="nom" value="<?php echo $infos['nom']; ?>"></div>

                <br>
                <br>

                <div><label for="password">Saisissez votre mot de passe pour confirmer vos modifications.</label></div>
                <br>
                <div><input type="password" name="password" placeholder="password"></div>

                <br>
                <br>

                <div><input type="submit" name="modifier" value="Enregistrer"></div>

                </form>
            </section>

            <section>
                <form action="profil.php" method='post'>
                <div><input type="submit" name="modifiermdp" value="modifiermdp"></div>
                </form>
            </section>

            <?php } ?>

            <?php if ($formulairemdp == 1) {
                ?>
                <form action="profil.php" method='post'>
                    <div><label for="actualpassword">Mot de passe actuel</label></div>
                    <div><input type="password" name="actualpassword" placeholder ="password"></div>

                    <div><label for="newpassword">Nouveau mot de passe</label></div>
                    <div><input type="password" name="newpassword" placeholder ="nouveau mot de passe"></div>

                    <div><label for="confirmpassword">Confirmez le nouveau mot de passe</label></div>
                    <div><input type="password" name="confirmpassword" placeholder="confirmer mot de passe"></div>

                    <div><input type="submit" name="modifiermdp1" value="Enregistrer"></div>
                </form>
                <?php
            } ?>

            <section class='underform'> <!-- MODIFICATIONS REUSSIES  -->

                <div><?php if (isset($message)) { echo $message ;} ?></div>
                <div><?php if (isset($err_login)) { echo $err_login ;}?></div>
                <div><?php if (isset($err_prenom)) { echo $err_prenom ;} ?></div>
                <div><?php if (isset($err_nom)) { echo $err_nom ;} ?></div>
                <div><?php if (isset($err_password)) { echo $err_password;}?></div>

                <div>
                    <form action="profil.php" method="post">

                    <div><input type="submit" name="deconnexion" value="Se déconnecter"></div>
                    
                    </form>
              </div>

            </section>

        </main>

        <?php require('footer.php'); ?> <!--LINK VERS LE FOOTER -->

    </body>

</html>



