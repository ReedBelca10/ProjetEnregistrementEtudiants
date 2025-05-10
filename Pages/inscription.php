<?php
    require "db-connection.php";

    //Insertion des données d'inscription
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $lastname = htmlspecialchars($_POST['nom'] ?? '');
        $firstname = htmlspecialchars($_POST['prenoms'] ?? '');
        $gender = htmlspecialchars($_POST['genre'] ?? '');
        $email = htmlspecialchars($_POST['email'] ?? '');
        $password = $_POST['mdp'] ?? '';
        $confirmation = $_POST['confirmation'] ?? '';

        if($password === $confirmation){
            $sql = "INSERT INTO `internautes` (`nom_internaute`, `prenoms_internaute`, `sexe_internaute`, `email_internaute`, `mdp_internaute`) VALUES ('$lastname', '$firstname', '$gender', '$email', '$password')";
        }else{
            $message = "Le mot de passe et la confirmation doivent être conformes.";
        }

        $req = $PDO->prepare($sql);
        if($req->execute() === TRUE){
            header("Location:index.php");
            exit();
        }else{
            echo 'echec';
        }
    }

?>