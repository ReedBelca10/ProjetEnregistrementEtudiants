<?php
    //Connection à la BD
    require 'db-connection.php';

    if(!empty($_POST)){
    
        //Vérification de l'envoie de l'image
        if(isset($_FILES["image"]) && $_FILES["image"]["error"] === 0 && isset($_POST["matriculeEtudiant"], $_POST["nomEtudiant"], $_POST["prenomEtudiant"], $_POST["dateNaisEtudiant"], $_POST["genreEtudiant"], $_POST["telephoneEtudiant"], $_POST["emailEtudiant"], $_POST["filiereEtudiant"]) && !empty($_POST["matriculeEtudiant"]) && !empty($_POST["nomEtudiant"]) && !empty($_POST["emailEtudiant"]) && !empty($_POST["filiereEtudiant"])){
            //Image reçu 
            //Vérification d'extension et le type Mime
            $allowed = [
                "jpg" => "image/jpeg",
                "jpeg" => "image/jpeg",
                "png" => "image/png"
            ];

            $fileName = $_FILES["image"]["name"];
            $fileType = $_FILES["image"]["type"];
            $fileSize = $_FILES["image"]["size"];

            //Vérification de l'extension
            if (isset($fileName) && !empty($fileName)) {
                $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            } else {
                //Message d'erreur
                die("Erreur : Nom de fichier non défini");
            }
            
            //Vérification de l'absence de l'extension dans les clés de $allowed ou l'absence du type Mime dans les valeurs
            if (!isset($allowed[$extension]) || $allowed[$extension] !== $fileType) {
                //Message d'erreur
                die("Format de fichier incorrect.");
            }

            //Limitation du volume de fichier acceptable à 1Mo
            if($fileSize > 1024 * 1024){
                //Message d'erreur
                die("Fichier trop volumineux");
            }

            //Génération de nom unique
            $newName = md5(uniqid());
            //Génération du chemin complet
            $newFileName = __DIR__ . "/uploads/$newName.$extension";
            //Déplacement du fichier de tmp vers uploads
            if(!move_uploaded_file($_FILES["image"]["tmp_name"], $newFileName)){
                //Message d'erreur
                die("L'upload a échoué");
            }

            //Interdition des fichiers contre l'exécution
            chmod($newFileName, 0644);

            //Insertion des images dans la BD
            $sql1 = "INSERT INTO `photos_profils` (`nom_photo`, `typeMIME_photo`, `taille_photo`) VALUES (:nom, :type, :taille)";
            $query1 = $PDO->prepare($sql1);
            $query1->execute([
                ':nom' => $newFileName,
                ':type' => $fileType,
                ':taille' => $fileSize
            ]);

            //Insertion des données de l'étudiant
            $sql2 = "INSERT INTO `etudiants` (`mat_etu`, `nom_etu`, `prenoms_etu`, `date_nais_etu`, `sexe_etu`, `tel_etu`, `email_etu`, `filiere_etu`, `nom_photo`) VALUES (:matricule, :nomEtu, :prenom, :naissance, :sexe, :telephone, :email, :filiere, :nomPhoto)";
            $query2 = $PDO->prepare($sql2);
            $query2->execute([
                ':matricule' => $_POST["matriculeEtudiant"],
                ':nomEtu' => $_POST["nomEtudiant"],
                ':prenom' => $_POST["prenomEtudiant"],
                ':naissance' => $_POST["dateNaisEtudiant"],
                ':sexe' => $_POST["genreEtudiant"],
                ':telephone' => $_POST["telephoneEtudiant"],
                ':email' => $_POST["emailEtudiant"],
                ':filiere' => $_POST["filiereEtudiant"],
                ':nomPhoto' => $newFileName
            ]);

            header("Location: consultation.php");

        } else {
            
            //Message d'erreur
            die("Formulaire incomplet");
        }

    }
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>  
        <meta charset="UTF-8">
        <meta name="author" content="ReedBelca">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <link rel="stylesheet" href="style.css">
        <title>Ajout d'étudiant</title>
    </head>
<body>
    
    <div class="container" lang="en">
        <div class="conteneur-form">
            <h1>Enregistrement des étudiants</h1>
            <div class="main-form">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="profile">
                        <span class="profile">Profil:</span>
                        <input type="file" name="image" id="image">
                    </div>

                    <input type="number" name="matriculeEtudiant" id="matricule" placeholder="Matricule étudiant avec 5 caractères" required>
                    <input type="text" name="nomEtudiant" id="nom" placeholder="Nom de l'étudiant" required>
                    <input type="text" name="prenomEtudiant" id="prenom" placeholder="Prénoms de l'étudiant">
                    <div class="birthday">
                        <span class="birthday">Date de naissance :</span>
                        <input type="date" name="dateNaisEtudiant" class="birthday" id="naissance">
                    </div>
                    <div class="genre-container" id="add-form-gender">
                        <span>Genre:</span>
                        <label>
                        <input type="radio" name="genreEtudiant" value="masculin" checked="checked" required>
                        Masculin
                        </label>
                        <label>
                        <input type="radio" name="genreEtudiant" value="féminin">
                        Féminin
                        </label>
                    </div>
                    <input type="text" name="telephoneEtudiant" id="telephone" placeholder="Téléphone de l'étudiant">
                    <input type="email" name="emailEtudiant" id="e-mail" placeholder="nom@mail.com" required>
                    <input type="text" name="filiereEtudiant" id="filiere" placeholder="Filière de l'étudiant" required>
                    <div class="les-boutons">
                        <button id="annuler" name="annuler"><a href="add-form.php">Annuler</a></button>
                        <button id="enregistrer" name="enregistrer">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>