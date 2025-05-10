<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    require "db-connection.php";

    if(isset($_POST['Valider'])){
        if(!empty($_POST['email']) AND !empty($_POST['password'])){
            $email = htmlspecialchars($_POST['email']);
            $password = $_POST['password'];
            $req = $PDO->prepare("SELECT * FROM `internautes` WHERE `email_internaute` = ? AND  `mdp_internaute` = ?");
            $req->execute(array($email, $password));
            $account = $req->rowCount();

            if($account == 1){
                if($email === "reedbelca55@gmail.com"){
                    header("Location:consultation.php");
                    exit;
                }else{
                    header("Location:add-form.php");
                    exit;
                }
            }else{
                echo "Compte non trouvé" ;
            }
        }else{
            echo "Veuillez remplir tous les champs";
        }
    }