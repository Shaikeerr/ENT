<?php
    require('connexion/connexion.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un menu</title>
    <link rel="stylesheet" href="stylesheets/inserer_menu.css">
    <link rel="stylesheet" href="stylesheets/fonts.css">
</head>
<body>

<form action="creation_menu.php" method="post">
    <a href="restaurants.php?choix=1"> 🡄 Retour</a>
    <h2> Choisissez une cantine </h2>
    <select name="cantines" id="cantines_select">
        <option value="">--Choisissez une cantine--</option>
        <option value="1">L'Arlequin - Copernic</option>
        <option value="2">Cafétéria IUT</option>
        <option value="3">ESIEE</option>
    </select>

    <h2>Choisissez un jour</h2>
    <input class="date" type="date" name="date_menu" id="date_menu">

    <div class="menu">
        <h2>Composez le menu</h2>
        <h3> Entrée </h3>
        <input type="text" name="entree" id="entree" placeholder="Entrée">
        <h3> Plat </h3>
        <input type="text" name="plat" id="plat" placeholder="Plat">
        <h3> Dessert </h3>
        <input type="text" name="dessert" id="dessert" placeholder="Dessert">
    </div>

    <input class="submit" type="submit" value="Soumettre">
</form>


</body>
</html>