<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absences</title>
    <link rel="stylesheet" href="stylesheets/absences.css">
    <link rel="stylesheet" href="stylesheets/navbar.css">
    <link rel="stylesheet" href="stylesheets/fonts.css">
</head>
<body>

<?php 

session_start();
require ('connexion/connexion.php');

$sql_total = "SELECT SUM(heures_manquees) AS total_heures_manquees FROM absences WHERE id_user = :id_user";
$stmt = $db->prepare($sql_total);
$stmt->bindParam(':id_user', $_SESSION['id_user'], PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$total_heures_manquees = $result[0]["total_heures_manquees"];

$sql_justifiees = "SELECT * FROM absences WHERE id_user = :id_user AND motif_absence IS NOT NULL";
$stmt_justifiees = $db->prepare($sql_justifiees);
$stmt_justifiees->bindParam(':id_user', $_SESSION['id_user'], PDO::PARAM_STR);
$stmt_justifiees->execute();
$result_justifiees = $stmt_justifiees->fetchAll(PDO::FETCH_ASSOC);
$result_justifiees = array_reverse($result_justifiees);

$sql_non_justifiees = "SELECT * FROM absences WHERE id_user = :id_user AND motif_absence IS NULL";
$stmt_non_justifiees = $db->prepare($sql_non_justifiees);
$stmt_non_justifiees->bindParam(':id_user', $_SESSION['id_user'], PDO::PARAM_STR);
$stmt_non_justifiees->execute();
$result_non_justifiees = $stmt_non_justifiees->fetchAll(PDO::FETCH_ASSOC);
$result_non_justifiees = array_reverse($result_non_justifiees);
?>

<nav class="navbar">
        <a href="homepage.php" class="logo">
          <img src="images/logo.png" alt="accueil">
        </a>
        <ul class="nav-links">
          <li class="nav-item"><a href="calendrier.php">Calendrier</a></li>
          <li class="nav-item"><a href="notes.php">Notes</a></li>
          <li class="nav-item"><a href="absences.php">Absences</a></li>
          <li class="nav-item"><a href="reservations.php">Réservations</a></li>
          <li class="nav-item"><a href="restaurants.php?choix=1">Restauration</a></li>
          <li class="nav-item"><a href="applications.php">Applications</a></li>
        </ul>
      </nav>

<div class="main">
  <h1>Gestionnaire d'Absences</h1>

  <div class="boxes">
    <div class="box" id="box1">
      <h2> Justifiées </h2>
      <div class="liste">
        <?php foreach ($result_justifiees as $row) { 
          echo '<div class="element">';
          echo '<p class="date"> Date : ' . $row['date_absence'] . '</p>';
          echo '<div class="infos">';
          echo '<p class="motif"> Motif : ' . $row['motif_absence'] . '</p>';
          echo '<p class="heures">' . $row['heures_manquees'] . ' heures manquées </p>';
          echo '</div>';
          echo '</div>';

        }
          ?>
        </div>
      </div>


    <div class="box" id="box2">
      <h2> Non justifiées </h2>
      <div class="liste">

        <?php 
        foreach ($result_non_justifiees as $row) { 
          echo '<div class="element">';
          echo '<p class="date"> Date : ' . $row['date_absence'] . '</p>';
          echo '<div class="infos">';
          echo '<p class="heures">' . $row['heures_manquees'] . ' heures manquées </p>';
          echo '</div>';
          echo '</div>';

        }
          ?>
      </div>
  </div>
  <div class="box" id="box3">  
    <h2> Total d'heures manquées </h2>
    <div class="recap">
      <div class="total">
        <p class="nombre_total"><strong><?php echo $total_heures_manquees ?></strong>h</p>
      </div>
      <div class="rappel">
        <h2>  Rappel </h2>
        <ul>
          <li> A partir d’X heures non justifiées vous pourrez être sanctionné(e). 
          <li> Vous devez justifier votre absence dès votre retour en cours.
        </ul>
      </div>
    </div>
</div>
  </div>

</body>
</html>