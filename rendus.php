<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservations</title>
    <link rel="stylesheet" href="stylesheets/desktop/rendus.css">
    <link rel="stylesheet" href="stylesheets/navbar.css">
    <link rel="stylesheet" href="stylesheets/fonts.css">
</head>
<body>

<nav class="navbar">
    <a href="homepage.php" class="logo">
        <img src="images/logo.png" alt="accueil">
    </a>
    <img src="images/burger_icon.png" alt="burger" class="burger">
    <ul class="nav-links">
        <li class="nav-item"><a href="calendrier.php">Calendrier</a></li>
        <li class="nav-item"><a href="notes.php">Notes</a></li>
        <li class="nav-item"><a href="absences.php">Absences</a></li>
        <li class="nav-item"><a href="rendus.php">Rendus</a></li>
        <li class="nav-item"><a href="restaurants.php?choix=1">Restauration</a></li>
        <li class="nav-item"><a href="https://elearning.univ-eiffel.fr" target="_blank">E-Learning</a></li>
        <li class="nav-item"> <a href="logout.php"> Déconnexion</a> </li>
    </ul>
</nav>

<?php
    session_start();
    require('connexion/connexion.php');
    if (isset ($_GET['choix']))
        $choix = $_GET['choix'];
    else
        $choix = 1;
    $date_actuelle = date("Y-m-d");
    $debut_semaine = strtotime(date('Y-W', strtotime($date_actuelle)) . '-1'); // 1 représente le lundi
?>

<div class="main">
    <h1 class="title">Cahier de Texte Numérique</h1>

    <div class="tabs">
        <a href='rendus.php?choix=1' class="tab <?php echo ($choix == 1) ? 'active' : ''; ?>">À Venir</a>
        <a href='rendus.php?choix=2' class="tab <?php echo ($choix == 2) ? 'active' : ''; ?>">Tout</a>
    </div>

    <div class="rendus">
        <?php 
        if ($choix == 1) {
            echo "<h2 class='subtitle'>Rendus à venir</h2>";
            $sql = "SELECT * FROM rendus JOIN matieres ON rendus.id_matiere = matieres.id_matiere WHERE date_rendu >= :date_actuelle ORDER BY date_rendu ASC LIMIT 5";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':date_actuelle', $date_actuelle);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            echo "<h2 class='subtitle'>Tous les rendus</h2>";
            $sql = "SELECT * FROM rendus JOIN matieres ON rendus.id_matiere = matieres.id_matiere WHERE date_rendu >= :date_actuelle ORDER BY date_rendu ASC";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':date_actuelle', $date_actuelle);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        foreach ($result as $row) {
            $date_rendu = $row['date_rendu'];
            $matiere = $row['nom_matiere'];
            $description = $row['description_rendu'];

            echo "<div class='rendu'>";
            echo "<h3 class='date'>" . date('d/m', strtotime($date_rendu)) . "</h3>";
            echo "<h3 class='matiere'>$matiere</h3>";
            echo "<p class='description'>$description</p>";
            echo "</div>";
        }
        ?>
    </div>
</div>

</body>
<script src="scripts/burger.js"></script>
</html>
