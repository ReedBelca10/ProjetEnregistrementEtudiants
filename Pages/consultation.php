<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="ReedBelca">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">
    <title>Consultation</title>
</head>
<body>
    <div class="container my-5">
        <h2>Liste des étudiants</h2>
        <a class="btn btn-primary" href="add-form.php" role="button">Ajouter</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Profil</th>
                    <th>Matricule</th>
                    <th>Nom</th>
                    <th>Prénoms</th>
                    <th>Date de naissance</th>
                    <th>Genre</th>
                    <th>Téléphone</th>
                    <th>Email</th>
                    <th>Filière</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    //Connection à la BD
                    require 'db-connection.php';
                    
                    $sql = "SELECT * FROM etudiants 
                    LEFT JOIN photos_profils 
                    ON etudiants.nom_photo = photos_profils.nom_photo";

                    $result = $PDO->query($sql);

                    if (!$result) {
                        die("Erreur lors de l’exécution de la requête");
                    }

                    // Lire toutes les lignes
                    $rows = $result->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($rows as $row) {
                        // Vérifier si l’image existe, sinon afficher une image par défaut
                        $photo = !empty($row['nom_photo']) ? "uploads/{$row['nom_photo']}" : "default-avatar.jpg";

                        echo "
                        <tr>
                            <td><img src='{$photo}' alt='Photo de profil' width='50'></td>
                            <td>{$row['mat_etu']}</td>
                            <td>{$row['nom_etu']}</td>
                            <td>{$row['prenoms_etu']}</td>
                            <td>{$row['date_nais_etu']}</td>
                            <td>{$row['sexe_etu']}</td>
                            <td>{$row['tel_etu']}</td>
                            <td>{$row['email_etu']}</td>
                            <td>{$row['filiere_etu']}</td>
                            <td>
                                <a class='btn btn-primary btn-sm' href='modification.php?mat_etu={$row['mat_etu']}'>Modifier</a>
                                <a class='btn btn-danger btn-sm' href='suppression.php?mat_etu={$row['mat_etu']}'>Supprimer</a>
                            </td>
                        </tr>";
                    }
  
                ?>

            </tbody>
        </table>

    </div>  

</body>
</html>