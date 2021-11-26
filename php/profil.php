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

        header('Location: connexion.php');
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

        $login = $_POST['login'];
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $password = ($_POST['password']);
        $valid1 = (boolean) true;


        $testlogin = mysqli_query($mysqli, "SELECT * FROM utilisateurs WHERE login = '".$_SESSION['login']."' AND password = '".md5($password)."'") ;

        $mysqli_resultlogin = mysqli_num_rows($testlogin) ;

        // TEST LOGIN => CARACTERES, LONGUEUR, SI DEJA UTILISE ?

        if(empty($login)) {
            
            $err_login = "Veuillez renseigner votre login.";
            $valid1=false;
        }

        if ($login != $_SESSION['login']) { 

            if (($mysqli_resultlogin) ==1) { //on vérifie que ce pseudo n'est pas déjà utilisé par un autre membre
                $err_login = "Ce login est déjà utilisé.";
                $valid1= false;
            }
        }


        elseif (!preg_match("#^[a-z0-9]+$#",$login)) {
            $err_login = "Le login doit être renseigné uniquement en lettres minuscules, ou chiffres sans accents, sans caractères spéciaux.";
            $valid1= false;
        }

        elseif(strlen($login)>25) {             
            $err_login= "Le login est trop long, il dépasse 25 caractères.";
            $valid1= false;
        }

        // TEST PRENOM => CHAMP VIDE, CARACTERES ?
        if (empty($prenom)) {

            $err_prenom = "Veuillez renseigner votre prénom";
            $valid=false;
            
        }

        elseif(!preg_match("#^[a-z]+$#",$prenom)) {
            $err_prenom = "Le prénom doit être renseigné uniquement en lettres minuscules et sans accents.";
            $valid1= false;
        }
        
        // TEST NOM => CHAMP VIDE, CARACTERES ?

        if (empty($nom)) {
            $err_nom = "Veuillez renseigner votre nom";
        }

        elseif(!preg_match("#^[a-z]+$#",$nom)) {
            $err_nom = "Le nom doit être renseigné uniquement en lettres minuscules et sans accents.";
            $valid1= false;
            
        }

        // TESTS DU MDP SI VIDE PUIS SI CORRECT POUR CONFIRMATION

        $requetemdp = mysqli_query($mysqli, "SELECT * FROM utilisateurs WHERE login ='".$_SESSION['login']."' AND password = '".md5($password)."'") ;
        ; // REQUETE SQL SI MDP OK

        $mysqli_resultmdp = mysqli_num_rows($requetemdp);  // COMPTE LE NOMBRE DE LIGNES CORRESPONDANTES

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



        if($valid1) {

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


            $formulairemdp = 1;
            $formulaireinfos = 0; //CACHE FORMULAIRE INFO
            $actualpassword = $_POST['actualpassword'];
            $newpassword = md5($_POST['newpassword']);
            $confirmpassword = md5($_POST['confirmpassword']);

            $requete = mysqli_query($mysqli, "SELECT * FROM utilisateurs WHERE password = '".md5($actualpassword)."' && login = '".$_SESSION['login']."'") ; // REQUETE TEST MDP ACTUEL


            $mysqli_result = mysqli_num_rows($requete); // comptage des ligne de résultat de requete

            if(empty($actualpassword)) {

                $err_actualpassword = "Veuillez renseigner votre mot de passe actuel.";
                $valid2 = false;
            }

            if ($mysqli_result == 0) {

                $err_actualpassword = "Le mot de passe actuel est incorrect.";
                $valid2 = false;
            }


            if(empty($newpassword)) {

                $err_newpassword = "Veuillez renseigner votre nouveau mot de passe.";
                $valid2 = false;
            }

            if(empty($confirmpassword)) {

                $err_confirmpassword = "Veuillez confirmer votre nouveau mot de passe.";
                $valid2 = false;
            }

            elseif($newpassword != $confirmpassword) {

                $err_2password = "Les nouveaux mot de passes ne correspondent pas. Veuillez réessayer.";
                $valid2 = false;      


            }
            

            if($valid2) {
                
                $sql = "UPDATE utilisateurs SET password ='$newpassword'WHERE login = '".$_SESSION['login']."'";

                if (mysqli_query($mysqli, $sql) ) {
        
                    $message = "Vos modifications ont été enregistrées avec succès!";
    
                    $formulairemdp = 0;
    
    
                    
    
                }

                
                
                    
            }
            

            
    } 

?>

<html lang="fr">

    <head>
        <meta charset="utf-8">
            <link rel="stylesheet" href="../style/mainforms.css">
            <link rel="stylesheet" href="../style/header.css">
            <link rel="stylesheet" href="../style/footer.css">
        
        <title>Profil</title>
    </head>

    <body>

        <header>
            <?php require('header2.php'); ?> <!-- LINK AVEC LE HEADER -->
        </header>

        <main>

    

            <h1><?php echo $_SESSION['login']?>,<br> bienvenue sur ton profil.</h1>

            <section>

                <?php if ($formulaireinfos ==1 ) { ?>

                <div class="reglesform">Si tu souhaites modifier les informations de ton profil ça se passe juste ci-dessous !</div>

                <form action="profil.php" method="post" id="modif_utilisateurs" class="styleform">
                
                <div><label for="login">Login</label></div>
                <div class="underform"><?php if (isset($err_login)) { echo $err_login ;}?></div>
                <div><input type="text" name="login" class="inputbasic" value="<?php echo $infos['login']; ?>"></div>

                <br>

                <div><label for="prenom">Prénom</label></div>
                <div class="underform"><?php if (isset($err_prenom)) { echo $err_prenom ;} ?></div>
                <div><input type="text" name="prenom" class="inputbasic" value="<?php echo $infos['prenom']; ?>"></div>

                <br>

                <div><label for="nom">Nom</label></div>
                <div class="underform"><?php if (isset($err_nom)) { echo $err_nom ;} ?></div>
                <div><input type="text" name="nom" class="inputbasic" value="<?php echo $infos['nom']; ?>"></div>

                <br>

                <div><label for="password">Confirmez vos modifications avec votre mot de passe.</label></div>
                <div class="underform"><?php if (isset($err_password)) { echo $err_password;}?></div>
                <div><input type="password" name="password" placeholder="password" class="inputbasic"></div>

                <br>
                <br>

                <div><input type="submit" name="modifier" value="Enregistrer" class="inputbasic"></div>

                <div><input type="submit" name="modifiermdp" value="Modifier le mot de passe" class="inputbasic"></div><br>
                

                

                <div><input type="submit" name="deconnexion" value="Se déconnecter" class="inputbasic"></div>



                </form>

                <?php } ?>
            </section>

            <section>

                
                <form action="profil.php" method='post'>
                <div class="underform"><?php if (isset($message)) {echo $message ;?></div></br>
                <div><input type="submit" name="deconnexion" value="Se déconnecter" class="inputbasic"></div><br>
                <div><a href="profil.php"><input type="button" name="retourprofil" value="Retour au profil" class="inputbasic"></div><br>
                </form>
                
                <?php } ?>
                   
                
                </form>
            </section>


            <div class="underform">
                <?php if (isset($messagemdp)) {echo $messagemdp ;} ?>
            </div>

            

            <?php if ($formulairemdp == 1) { ?>
                <form action="profil.php" method='post' class="styleform">
                    <div class="underform"><?php if (isset($err_actualpassword)) { echo $err_actualpassword;}?></div>
                    <div><input type="password" class="inputbasic" name="actualpassword" placeholder ="mot de passe actuel"></div>

                    <br>
                    <br>

                    <div class="underform"><?php if (isset($err_newpassword)) { echo $err_newpassword;}?></div>
                    <div><input type="password" class="inputbasic" name="newpassword" placeholder ="nouveau mot de passe"></div>

                    <br>
                    <br>

                    <div class="underform"><?php if (isset($err_confirmpassword)) { echo $err_confirmpassword;}?></div>
                    <div><input type="password" class="inputbasic" name="confirmpassword" placeholder="confirmer mot de passe"></div>

                    <br>
                    <div class="underform"><?php if (isset($err_2password)) { echo $err_2password;}?></div>
                    <br>

                    <div><input type="submit" name="modifiermdp1" value="Enregistrer" class="inputbasic"></div>

                    <div><input type="submit" name="profilback" value="Retour sur le profil" class="inputbasic"></div><br>

                    <div><input type="submit" name="deconnexion" value="Se déconnecter" class="inputbasic"></div>
                </form>
            <?php } ?>
                
  



        </main>

        <?php require('footer.php'); ?> <!--LINK VERS LE FOOTER -->

    </body>

</html>



