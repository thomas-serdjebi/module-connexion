<?php

//Déclaration des variables de connexion
 
$BDD = array();
$BDD ['host'] = "localhost" ;
$BDD ['user'] = "root" ;
$BDD ['pass'] = "" ;
$BDD ['db'] = "moduleconnexion" ;
$table = "utilisateurs";

$mysqli = mysqli_connect ( $BDD ['host'], $BDD ['user'], $BDD ['pass'], $BDD ['db'] ) ;

if (!$mysqli) {
    $err_connexion = "La connexion à la base de données '".$BDD['db']."' a échoué ";
}



?>