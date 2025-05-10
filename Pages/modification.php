 <?php

    require "db-connection.php";

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        if(!isset($_GET["mat_etu"])) {
            header("Location: consultation.php");
            exit;
        }
   
        $matricule = $_GET["mat_etu"];

        $sql = "SELECT * FROM etudiants WHERE mat_etu = $matricule";
        $result = $PDO->query($sql);
        if (!$result) {
            die("Erreur lors de l’exécution de la requête");
        }
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);

        if(!$rows) {
            header("Location: consultation.php");
            exit;
        }

        $matricule = $rows["mat_etu"];
        $nom = $rows["nom_etu"];
        $prenom = $rows["prenoms_etu"];
        $naissance = $rows["date_nais_etu"];
        $genre = $rows["sexe_etu"];
        $telephone = $rows["tel_etu"];
        $email = $rows["email_etu"];
        $filiere = $rows["filiere_etu"];
    
    } else {
    
        $matricule = $_POST["matriculeEtudiant"];
        $nom = $_POST["nomEtudiant"];
        $prenom = $_POST["prenomEtudiant"];
        $naissance = $_POST["dateNaisEtudiant"];
        $genre = $_POST["genreEtudiant"];
        $telephone = $_POST["telephoneEtudiant"];
        $email = $_POST["emailEtudiant"];
        $filiere = $_POST["filiereEtudiant"];

        do {
            if (empty($matricule) || empty($nom) || empty($prenom) || empty($naissance) || empty($genre) || empty($email) || empty($filiere)) {
                die('Veuillez remplir tous les champs');
            }

            $sql = "UPDATE etudiants SET `nom_etu` = '$nom', `prenoms_etu` = '$prenom', `date_nais_etu` = '$naissance', `sexe_etu` = '$genre', `tel_etu` = '$telephone', `email_etu` = '$email', `filiere_etu = '$filiere' WHERE `mat_etu` = '$matricule'";

            $result = $PDO->query($sql);
            if (!$result) {
                die("Erreur lors de l’exécution de la requête");
            } else {
                header("Location: consultation.php");
                exit;
            }
                
        } while (false);
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
        <title>modification d'étudiant</title>
    </head>
<body>
    
    <div class="container" lang="en">
        <div class="conteneur-form">
            <h1>Enregistrement des étudiants</h1>
            <div class="main-form">
                <form action="" method="post" enctype="multipart/form-data">
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