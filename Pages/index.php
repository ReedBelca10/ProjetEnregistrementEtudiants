<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="ReedBelca">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Connexion | Inscription</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="inscription.php" method="POST">
                <h1>Inscription</h1>
                <span id="sign-up-span">Utilisez vos informations pour vous inscrire</span>
                <input type="text" name="nom" placeholder="Nom de famille" required>
                <input type="text" name="prenoms" placeholder="Prénoms">
                <div class="genre-container">
                    <span>Genre:</span>
                    <label>
                      <input type="radio" name="genre" value="MASCULIN" checked="checked" required>
                      Masculin
                    </label>
                    <label>
                      <input type="radio" name="genre" value="FEMININ">
                      Féminin
                    </label>
                </div>
                <input type="email" name="email" placeholder="nom@mail.com" required>
                <input type="password" name="mdp" placeholder="Mot de passe">
                <input type="password" name="confirmation" placeholder="Confirmation">
                <button>S'inscrire</button>
            </form>
        </div>

        <div class="form-container sign-in">
            <form action="connexion.php" method="POST">
                <h1>Connexion</h1>
                <span>Utilisez votre Email et Mot de passe pour vous connecter</span>
                <input type="email" name="email" placeholder="nom@mail.com">
                <input type="password" name="password" placeholder="Mot de passe">
                <a href="#">Mot de passe oublié ?</a>
                <button name="Valider">Se Connecter</button>
            </form>
        </div>

        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Bienvenue !</h1>
                    <p>Entrez vos informations personnelles pour utiliser toutes les fonctionnalités du site</p>
                    <button class="hidden" id="login">Se Connecter</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Salut, cher ami !</h1>
                    <p>Inscrivez-vous pour utiliser toutes les fonctionnalités du site</p>
                    <button class="hidden" id="register">S'inscrire</button>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>