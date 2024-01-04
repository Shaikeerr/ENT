<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentification</title>
    <link rel="stylesheet" href="stylesheets/login.css">
    <link rel="stylesheet" media='screen and (max-width: 800px)' href="stylesheets/login800.css">
    <link rel="stylesheet" media='screen and (max-width: 600px)' href="stylesheets/login600.css">
    <link rel="stylesheet" href="stylesheets/fonts.css">
</head>
<body>
    <div class="form">
        <h2>Authentification</h2>
        <form action="connexion/login.php" method="post">
            <div class="radio">
                <div class="radio_group">
                    <label for="etudiant">Je suis un <br><strong>Etudiant</strong></label>
                    <input type="radio" id="etudiant" name="type" value="etudiant" checked required>
                </div>
                <div class="radio_group">
                    <label for="enseignant">Je suis un <br><strong>enseignant</strong></label>
                    <input type="radio" id="enseignant" name="type" value="enseignant" required>
                </div>
                <div class="radio_group">
                    <label for="personnel">Je suis du <br><strong>personnel</strong></label>
                    <input type="radio" id="personnel" name="type" value="personnel" required>
                </div>
            </div>
            <label for="username">Identifiant</label><br>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Mot de passe</label><br>
            <input type="password" id="password" name="password" required><br>
            <input class=submit type="submit" value="Se Connecter">
        </form>
    </div>
</body>
</html>