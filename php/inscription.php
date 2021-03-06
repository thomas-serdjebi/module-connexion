<?php

 require('connexiondb.php');

 $afficherformulaire = 1;
 
    if(!empty($_POST)) {
    extract($_POST);
        $valid =(boolean) true;

            // ELIMINATION DES ESPACES VIDES 

            if(isset($_POST['inscription'])){

                $login = (String) trim($login);

                $prenom = (String) trim($prenom);

                $nom = (String) trim($nom);

                $password = (String) trim($password);

                // TEST LOGIN => CHAMP VIDE, CARACTERES, LONGUEUR, SI DEJA UTILISE ?

                if(empty($login)) {
                    $err_login = "Veuillez renseigner le login !";
                    $valid= false;

                }

                elseif(!preg_match("#^[a-z0-9]+$#",$login)) {
                    $err_login = "Le login doit être renseigné uniquement en lettres minuscules, ou chiffres sans accents, sans caractères spéciaux.";
                    $valid= false;
                }

                elseif(strlen($login)>25) {             
                    $err_login= "Le login est trop long, il dépasse 25 caractères.";
                    $valid= false;
                }

                $testlogin = mysqli_query($mysqli, "SELECT * FROM utilisateurs WHERE login='".$login."'");

                $mysqli_result = mysqli_num_rows($testlogin) ;

                if (($mysqli_result) ==1) { //on vérifie que ce pseudo n'est pas déjà utilisé par un autre membre
                    $err_login = "Ce login est déjà utilisé.";
                    $valid= false;
                }

                // TEST PRENOM => CHAMP VIDE, CARACTERES ?
                

                if(empty($prenom)) {
                    $err_prenom = "Veuillez renseigner votre prénom !";
                    $valid= false;

                }

                elseif(!preg_match("#^[a-z]+$#",$prenom)) {
                    $err_prenom = "Le prénom doit être renseigné uniquement en lettres minuscules, sans accents, sans caractères spéciaux.";
                    $valid= false;
                }


                // TEST NOM => CHAMP VIDE, CARACTERES ?


                if(empty($nom)) {
                    $err_nom = "Veuillez renseigner votre nom !";
                    $valid= false;

                }

                elseif(!preg_match("#^[a-z]+$#",$nom)) {
                    $err_nom = "Le nom doit être renseigné uniquement en lettres minuscules et sans accent, sans caractères spéciaux.";
                    $valid= false;
                }

                // TEST MDP => CHAMP VIDE ?

                if(empty($password)) {
                    $err_password = "Veuillez renseigner votre mot de passe !";
                    $valid= false;

                }



                if($valid) {

                    mysqli_select_db ($mysqli, 'moduleconnexion') ;
                    
                    $sql = "INSERT INTO utilisateurs ( login, prenom, nom, password) VALUES ('$login', '$prenom', '$nom', '".md5($password)."')";
    
                    if (mysqli_query($mysqli, $sql)) {
    
                        $suscribeok = "Félicitations, vous êtes inscrit avec succès!";


                       
                    }
    

                    mysqli_close($mysqli);

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
        <title>Inscription</title>
    </head>

    <body>

        <header>
            <?php require('header2.php'); ?> <!-- LINK AVEC LE HEADER -->
        </header>

        <main>

    

            <h1>Inscription</h1>

            <section class="formulaire">

                <div class="reglesform">
                    <div id="renseignez"> Veuillez renseigner vos informations ci dessous.</br></div>
                    Le login doit être renseigné uniquement en lettres minuscules, 
                    ou chiffres sans accents, sans caractères spéciaux, 
                    et ne doit pas dépasser 25 caractères. Les noms et prénoms 
                    doivent également être renseignés uniquement en lettres miniscules et 
                    sans caractères spéciaux.
                </div>








                <?php 
                    if (isset($err_connexion)) { echo $err_connexion;}
                    if ($afficherformulaire == 1) { 
                ?>

                    <section class='underform'> <!-- INSCRIPTION REUSSIE  -->
                <div>
                    <?php 
                        if (isset($suscribeok)) { echo $suscribeok  ;} 
                    ?>
                </div>

                        <form method="post" action="inscription.php" class="styleform">
                                <div class="underform"><?php if(isset($err_login)) {echo $err_login ;}?></div>
                                <div><input type="text" name="login" placeholder="login" class="inputbasic"></div>

                                <div class="underform"><?php if(isset($err_prenom)) {echo $err_prenom ;}?></div>
                                <div><input type="text" name="prenom" placeholder="prenom" class="inputbasic"><div>
                           
                                <div class="underform"><?php if(isset($err_nom)) {echo $err_nom ;}?></div>
                                <div><input type="text" name="nom" placeholder="nom" class="inputbasic"></div>
                            
                                <div class="underform"><?php if(isset($err_password)) {echo $err_password ;}?></div>
                                <div><input type="password" name="password" placeholder="password" class="inputbasic"></div>
                            

                                <input type="submit" name="inscription" value="S'inscrire" class="inputbasic">
                                <br>

                                <div class="reglesform"> Déjà inscrit ? Connectez vous ci dessous !<br>
                                <a href="connexion.php"><input type="button" class="inputbasic" value="Connexion"></a>
                                </div>

                            
                        </form>

                       


            </section>

            <?php 
            } 
            ?>





            </section>
                

                


                

            
           




        </main>


            
        <?php require('footer.php'); ?> <!--LINK VERS LE FOOTER -->



    </body>

</html>
