<?php
    require('connexion/connexion.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soumettre une Fréquentation</title>
    <link rel="stylesheet" href="stylesheets/soumettre_frequentation.css">
    <link rel="stylesheet" href="stylesheets/fonts.css">
</head>
<body>

    <form action="soumission.php" method="post">
    <a href="restaurants.php?choix=1"> 🡄 Retour</a>
    <div class="radio">
                <h2>Choisissez une cantine</h2>
                <div class="radio_group">
                    <label for="copernic">Copernic</label>
                    <input type="radio" id="copernic" name="cantine" value="1" checked required>
                </div>
                <div class="radio_group">
                    <label for="cafeteria">Cafétéria IUT</strong></label>
                    <input type="radio" id="cafeteria" name="cantine" value="2" required>
                </div>
                <div class="radio_group">
                    <label for="esiee">ESIEE</label>
                    <input type="radio" id="esiee" name="cantine" value="3" required>
                </div>
            </div>
                <div class="frequentation">
                <h2>Quelle est la fréquentation ?</h2>
                <div class="radio_group">
                    <label for="one">Faible</label>
                    <input type="radio" id="one" name="freq" value="1" checked required>
                </div>
                <div class="radio_group">
                    <label for="two">Moyenne</strong></label>
                    <input type="radio" id="two" name="freq" value="2" required>
                </div>
                <div class="radio_group">
                    <label for="three">Elevée</label>
                    <input type="radio" id="three" name="freq" value="3" required>
                </div>
                <div class="radio_group">
                    <label for="four">Très Elevée</label>
                    <input type="radio" id="four" name="freq" value="4" required>
                </div>
            </div>
            
        <input class="submit" type="submit" value="Soumettre">

</body>
</html>