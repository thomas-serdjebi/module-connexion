<?php

//Déclaration des variables de connexion
 
$BDD = array();
$BDD ['host'] = "localhost:3306" ;
$BDD ['user'] = "thomas-serdjebi" ;
$BDD ['pass'] = "Hermes3B080!" ;
$BDD ['db'] = "thomas-serdjebi_moduleconnexion" ;
$table = "utilisateurs";

$mysqli = mysqli_connect ( $BDD ['host'], $BDD ['user'], $BDD ['pass'], $BDD ['db'] ) ;

if (!$mysqli) {
    $err_connexion = "La connexion à la base de données '".$BDD['db']."' a échoué ";
}



?>