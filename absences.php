<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absences</title>
    <link rel="stylesheet" href="stylesheets/desktop/absences.css">
    <link media="screen and (max-width: 600px)" rel="stylesheet" href="stylesheets/mobile/absences_mobile.css">
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
$heures_manquees = $result[0]["total_heures_manquees"];
$total_heures_manquees;

$sql_absences_injustifiées = "SELECT SUM(heures_manquees) AS total_heures_manquees FROM absences WHERE id_user = :id_user AND motif_absence IS NULL";
$stmt_absences_injustifiées = $db->prepare($sql_absences_injustifiées);
$stmt_absences_injustifiées->bindParam(':id_user', $_SESSION['id_user'], PDO::PARAM_STR);
$stmt_absences_injustifiées->execute();
$result_absences_injustifiees = $stmt_absences_injustifiées->fetchAll(PDO::FETCH_ASSOC);
$heures_manquees_non_justifiees = $result_absences_injustifiees[0]["total_heures_manquees"];

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

function calculerResultat($heures_manquees_non_justifiees) {
  $limiteInfTranche1 = 11;
  $limiteInfTranche2 = 21;
  $limiteInfTranche3 = 30;

  $deductionTranche1 = 0.025;
  $deductionTranche2 = 0.05;
  $deductionTranche3 = 0.1;

  $total_heures_manquees = 0;

  if ($heures_manquees_non_justifiees >= $limiteInfTranche3) {
      $total_heures_manquees += ($limiteInfTranche3 - $limiteInfTranche2) * $deductionTranche2;
      $total_heures_manquees += ($limiteInfTranche2 - $limiteInfTranche1) * $deductionTranche1;
      $total_heures_manquees += ($heures_manquees_non_justifiees - $limiteInfTranche3) * $deductionTranche3;
  } elseif ($heures_manquees_non_justifiees >= $limiteInfTranche2) {
      $total_heures_manquees += ($limiteInfTranche2 - $limiteInfTranche1) * $deductionTranche1;
      $total_heures_manquees += ($heures_manquees_non_justifiees - $limiteInfTranche2) * $deductionTranche2;
  } elseif ($heures_manquees_non_justifiees >= $limiteInfTranche1) {
      $total_heures_manquees += ($heures_manquees_non_justifiees - $limiteInfTranche1) * $deductionTranche1;
  }

  return max(0, $total_heures_manquees);
} 
?>

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

<div class="main">
  <h1>Gestionnaire d'Absences</h1>

  <div class="buttons_container">
    <button class="button" id="button1"> Justifiées </button>
    <button class="button" id="button2"> Non justifiées </button>
    <button class="button" id="button3"> Récap </button>
  </div>

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
        <p class="nombre_total"><strong><?php 
        if ($heures_manquees == 0) {
          echo '0';
        } else {
          echo $heures_manquees;
        }

        ?></strong>h</p>
      </div>
      <div class="rappel">
        <h2>  Rappel </h2>
        <ul>
          <li> A partir de 10 heures non justifiées, des sanctions seront possibles  </li> 
          <li> Actuellement, vous avez perdu <strong><?php echo calculerResultat($heures_manquees_non_justifiees); ?></strong> points </li>
        </ul>
      </div>
    </div>
</div>
  </div>

</body>
<script src="scripts/burger.js"></script>
<script src="scripts/absences.js"></script>
</html>