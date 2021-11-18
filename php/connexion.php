<?php



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

            <section>

                <form method="post">
                    <div>
                        <input type="text" name="login" placeholder="login">
                    </div>
                    <div>
                        <input type="password" name="password" placeholder="password">
                    </div>

                    <input type="submit" name="connexion" value="Connexion">
                </form>

            </section>

            <section class="underform">

            <!-- RAJOUTER VOUS ETES NOUVEAU ICI ? SINSCRIRE -->

  





           




        </main>


            
        <?php require('footer.php'); ?> <!--LINK VERS LE FOOTER -->



    </body>

</html>