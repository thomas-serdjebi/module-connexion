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

                if(empty($login)) {
                    $err_login = "Veuillez renseigner le login !";
                    $valid= false;

                }

                elseif(!preg_match("#^[a-z0-9]+$#",$login)) {
                    $err_login = "Le pseudo doit être renseigné uniquement en lettres minuscules, sans accents, sans caractères spéciaux.";
                    $valid= false;
                }

                elseif(strlen($login)>12) {             
                    $err_login= "Le pseudo est trop long, il dépasse 12 caractères.";
                    $valid= false;
                }
                

                if(empty($prenom)) {
                    $err_prenom = "Veuillez renseigner votre prénom !";
                    $valid= false;

                }

                elseif(!preg_match("#^[a-z]+$#",$prenom)) {
                    $err_prenom = "Le prénom doit être renseigné uniquement en lettres minuscules et sans accents.";
                    $valid= false;
                }



                if(empty($nom)) {
                    $err_nom = "Veuillez renseigner votre nom !";
                    $valid= false;

                }

                elseif(!preg_match("#^[a-z]+$#",$nom)) {
                    $err_nom = "Le nom doit être renseigné uniquement en lettres minuscules et sans accents.";
                    $valid= false;
                }

                if(empty($password)) {
                    $err_password = "Veuillez renseigner votre mot de passe !";
                    $valid= false;

                }


                // elseif (mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM utilisateurs WHERE login='".$login."'")==1)) { //on vérifie que ce pseudo n'est pas déjà utilisé par un autre membre
                //     $err_login = "Ce pseudo est déjà utilisé.";
                //     $valid= false;
                // }

                if($valid) {

                    mysqli_select_db ($mysqli, 'moduleconnexion') ;
                    
                    $sql = "INSERT INTO utilisateurs ( login, prenom, nom, password) VALUES ('$login', '$prenom', '$nom', '".hash('sha256', $password)."')";
    
                    if (mysqli_query($mysqli, $sql)) {
    
                        $suscribeok = "Félicitations, vous êtes inscrit avec succès";
                    }
    

                    mysqli_close($mysqli);

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
        <title>Accueil</title>
    </head>

    <body>

        <header>
            <?php require('header.php'); ?> <!-- LINK AVEC LE HEADER -->
        </header>

        <main>

    

            <h1>Inscription</h1>

            <section>

                <?php 
                    if ($afficherformulaire == 1) { ?>

                <form method="post" action="inscription.php">
                    <div>
                        <input type="text" name="login" placeholder="login">
                    </div>
                    <div>
                        <input type="text" name="prenom" placeholder="prenom">
                    </div>
                    <div>
                        <input type="text" name="nom" placeholder="nom">
                    </div>
                    <div>
                        <input type="password" name="password" placeholder="password">
                    </div>

                    <input type="submit" name="inscription" value="S'inscrire">
                </form>

            </section>

            <?php 
            } 
            ?>



            <section class='underform'> <!-- INSCRIPTION REUSSIE  -->
                <div>
                    <?php 
                        if (isset($suscribeok)) { echo $suscribeok  ;} 
                    ?>
                </div>

            </section>

            <section class="underform"> <!-- ERREUR CAR CHAMP MANQUANTS -->
                <div><?php if(isset($err_login)) {echo $err_login ;}?></div>

                <div><?php if(isset($err_prenom)) {echo $err_prenom ;}?></div>

                <div><?php if(isset($err_nom)) {echo $err_nom ;}?></div>

                <div><?php if(isset($err_password)) {echo $err_password ;}?></div>

            </section>

           




        </main>


            
        <?php require('footer.php'); ?> <!--LINK VERS LE FOOTER -->



    </body>

</html>
