<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier</title>
    <link rel="stylesheet" href="stylesheets/desktop/calendrier.css">
    <link media="screen and (max-width: 600px)" rel="stylesheet" href="stylesheets/mobile/calendrier_mobile.css">
    <link rel="stylesheet" href="stylesheets/navbar.css">
    <link rel="stylesheet" href="stylesheets/fonts.css">
</head>
<body>

<?php 
session_start();
require('connexion/connexion.php');

$semaine = date('W');
$date_actuelle = date('Y-m-d');

$debut_semaine = strtotime('this week monday', strtotime($date_actuelle));
$joursData = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi');


if ($_SESSION['id_fonction'] == 1) {
    echo '<nav class="navbar">
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
        <li class="nav-item"><a href="connexion/logout.php">Déconnexion</a></li>
    </ul>
</nav>';


} else if ($_SESSION['id_fonction'] == 2) {
    echo '<nav class="navbar">
    <a href="homepageprof.php" class="logo">
        <img src="images/logo.png" alt="accueil">
    </a>
    <ul class="nav-links">
    <li class="nav-item"> <a href="ajout_cours.php"> Ajouter un cours</a> </li>
    <li class="nav-item"> <a href="ajout_ressource.php"> Ajouter une ressource</a> </li>   
    <li class="nav-item"> <a href="ajout_rendu.php"> Ajouter un rendu</a> </li>
    <li class="nav-item"> <a href="ajout_notes.php"> Ajouter une note</a> </li>
    <li class="nav-item"> <a href="calendrier.php"> Calendrier</a> </li>
    <li class="nav-item"> <a href="logout.php"> Déconnexion</a> </li>
    </ul>
</nav>';
}



?> 



<div class="main">
    <div class="week">
    <?php
    echo "<h1>Semaine $semaine</h1>";
    echo "<div class='week_days'>";
    echo "<img src='images/arrow-left.png' alt='arrow_left' class='arrow' id='arrow_left'>";
    echo "<div class='days'>";
for ($jour = 0; $jour < 5; $jour++) {
    $date_jour = date('Y-m-d', strtotime("+$jour day", $debut_semaine));

    echo "<div class='day' id='day$jour'>";
    echo "<h2>" . $joursData[$jour] .' '  . date('d/m', strtotime($date_jour)) . "</h2>";

    for ($creneau = 1; $creneau < 5; $creneau++) {
        $sql = "SELECT sous_matieres.nom_sous_matiere FROM cours JOIN sous_matieres ON cours.id_sous_matiere = sous_matieres.id_sous_matiere WHERE date_cours = :date_jour AND cours.creneau_cours = $creneau;";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':date_jour', $date_jour, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<div class='creneau'>";

        if (count($result) == 0) {
            echo '';
        } else {
            echo '<h3>' . $result[0]['nom_sous_matiere'] . '</h3>';
        }

        $sql_professeurs  = "SELECT professeurs.nom_professeur, professeurs.prenom_professeur FROM cours JOIN professeurs ON cours.id_professeur = professeurs.id_professeur WHERE date_cours = :date_jour AND cours.creneau_cours = $creneau;";
        $stmt = $db->prepare($sql_professeurs);
        $stmt->bindParam(':date_jour', $date_jour, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) == 0) {
            echo '';
        } else {
            echo '<p>' . $result[0]['nom_professeur'] . ' ' . $result[0]['prenom_professeur'] . '</p>';
        }

        $sql_salles = "SELECT salles.nom_salle FROM cours JOIN salles ON cours.id_salle = salles.id_salle WHERE date_cours = :date_jour AND cours.creneau_cours = $creneau;";
        $stmt = $db->prepare($sql_salles);
        $stmt->bindParam(':date_jour', $date_jour, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) == 0) {
            echo '';
        } else {
            echo '<p>' . $result[0]['nom_salle'] . '</p>';
        }

        $sql_creneaux = "SELECT creneau_cours FROM cours WHERE date_cours = :date_jour AND cours.creneau_cours = $creneau;";
        $stmt = $db->prepare($sql_creneaux);
        $stmt->bindParam(':date_jour', $date_jour, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) == 0) {
            echo '';
        } else {
          echo '<p>';
          switch ($result[0]['creneau_cours']) {
            case 1:
                echo '8h15 - 10h15</p>';
                break;
            case 2:
                echo '10h30 - 12h30</p>';
                break;
            case 3:
                echo '13h30-15h30</p>';
                break;
            case 4:
                echo '15h45-17h45</p>';
                break;
            default:
                echo 'Non définie</p>';
        }
        }
        echo "</div>"; // Fermer la div pour le créneau
        if (($creneau + 1) % 3 == 0 && $creneau < 5) {
          echo "<div class='title-box'><h2>Repas</h2></div>";
      }
    }


    echo "</div>"; // Fermer la div pour le jour
    
}
echo "</div>"; // Fermer la div pour les jours
echo "<img src='images/arrow-right.png' alt='arrow_right' class='arrow' id='arrow_right'>";
echo "</div>"; // Fermer la div pour la semaine
?>


    </div>
</div>
    
</body>
<script src="scripts/burger.js"></script>
<script src="scripts/calendrier.js"></script>
</html>
