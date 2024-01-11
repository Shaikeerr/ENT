<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentification</title>
    <link rel="stylesheet" href="stylesheets/desktop/login.css">
    <link rel="stylesheet" media='screen and (max-width: 800px)' href="stylesheets/desktop/login800.css">
    <link rel="stylesheet" media='screen and (max-width: 600px)' href="stylesheets/desktop/login600.css">
    <link rel="stylesheet" href="stylesheets/fonts.css">
</head>
<body>
    <?php 
    
    $login_failed = false;
    if (isset($_GET['login_failed'])) {
        $login_failed = true;
    }

    echo $login_failed ? "<p class='error'>Identifiant ou mot de passe incorrect</p>" : "";

    ?>
    <div class="form">
        <h2>Authentification</h2>
        <form action="connexion/login.php" method="post">
            <div class="radio">
                <div class="radio_group">
                    <label for="etudiant">Je suis un <br><strong>Etudiant</strong></label>
                    <input type="radio" id="etudiant" name="type" value="1" checked required>
                </div>
                <div class="radio_group">
                    <label for="enseignant">Je suis un <br><strong>enseignant</strong></label>
                    <input type="radio" id="enseignant" name="type" value="2" required>
                </div>
                <div class="radio_group">
                    <label for="personnel">Je suis du <br><strong>personnel</strong></label>
                    <input type="radio" id="personnel" name="type" value="3" required>
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