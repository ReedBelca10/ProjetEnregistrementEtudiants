<?php

    if(isset($_GET["mat_etu"])) {
        $matricule = $_GET["mat_etu"];
        
        require_once 'db-connection.php';

        $sql = "DELETE FROM `etudiants` WHERE `mat_etu` = $matricule";
        $PDO->query($sql);
    
    }

    header("Location: consultation.php");
    exit;