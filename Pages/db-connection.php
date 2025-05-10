<?php
//L'inclusion du fichier db-config.php est nécessaire pour établir la connexion
require "db-config.php";

try
{
    $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS);
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //echo 'Connexion établie !';
}
catch(PDOException $pe)
{
    echo 'ERREUR : ' .$pe->getMessage();
}