<?php

session_start();



?>

<html lang="fr">

    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="/module-connexion/style/mainforms.css">
        <link rel="stylesheet" href="/module-connexion/style/header.css">
        <link rel="stylesheet" href="/module-connexion/style/footer.css">
        <link rel="stylesheet" href="/module-connexion/style/admin.css">
        <title>Admin</title>
    </head>

    <body>

        <header>
            <?php require('header.php'); ?> <!-- LINK AVEC LE HEADER -->
        </header>

        <main>

    
            <h1>Espace administrateur</h1>

            
            <section>

                

                    <?php


                        if (!isset($_SESSION['login']))  {
                            $err_admin="Seul l'administrateur peut accéder à cette page.";
                        }

                        elseif ($_SESSION['login'] != 'admin') {
                            $err_admin="Seul l'administrateur peut accéder à cette page.";

                        }

                        elseif (($_SESSION['login']) == 'admin') {

                            include_once('connexiondb.php');

                            $requete = "SELECT * FROM utilisateurs";

                            $resultat = mysqli_query($mysqli, $requete);

                            echo "<div class='reglesform'> Données des utilisateurs </div>";



                            echo"
                            <table>
                            <thead>
                            <tr>
                            <th>id</th>
                            <th>login</th>
                            <th>prénom</th>
                            <th>nom</th>
                            <th>password</th>
                            </tr>
                            </thead>";

                            while ($row = mysqli_fetch_array($resultat)) {
                                echo "<tbody>";
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['login'] . "</td>";
                                echo "<td>" . $row['prenom'] . "</td>";
                                echo "<td>" . $row['nom'] . "</td>";
                                echo "<td>" . md5($row['password']) . "</td>";
                                echo "</tr>";
                                echo "</tbody>";
                            }

                            echo"</table>" ;
        
                        }

                    ?>

                </table>

                <?php 

                    if (isset($_POST['deconnexion'])) {

                        session_destroy();

                        header('Location: http://localhost/module-connexion/php/connexion.php');

            
                    }

                ?>





            </section>


            <section>
                <div id="erradmin"><?php if (isset($err_admin)) { echo $err_admin ;}?></div></br>
            
            
            
            <form action='admin.php' method="post" form="styleform">
            <button type="submit" name="deconnexion" value="Se déconnecter" class="inputbasic">Se déconnecter</button>
            </form>


        </main>
            
        <?php require('footer.php'); ?> <!--LINK VERS LE FOOTER -->

    </body>

</html>







