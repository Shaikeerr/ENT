<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes</title>
    <link rel="stylesheet" href="stylesheets/desktop/calendrier.css">
    <link rel="stylesheet" href="stylesheets/navbar.css">
    <link rel="stylesheet" href="stylesheets/fonts.css">
    <link rel="stylesheet" href="stylesheets/desktop/notes.css">
    <link media="screen and (max-width: 600px)" rel="stylesheet" href="stylesheets/desktop/notes_phone.css">
</head>
<body>

<?php 

session_start();
require('connexion/connexion.php');

$id_matiere = isset($_GET['matiere']) ? $_GET['matiere'] : 0;
$id_sous_matiere = isset($_GET['sous_matiere']) ? $_GET['sous_matiere'] : 0;
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
  
<?php



$sql = "SELECT * from matieres ORDER BY nom_matiere ASC";
$stmt = $db->prepare($sql);
$stmt->execute();
$matieres = $stmt->fetchAll();

echo "<div class='container_matieres'>";
foreach ($matieres as $matiere) {
  echo "<div class='matieres'><a href='notes.php?matiere=".$matiere['id_matiere']."#sous_matiere'>".$matiere['nom_matiere']."</a></div>";
}
?> 

</div>

<?php 


if ($id_matiere != 0) {
  $sql = "SELECT * from sous_matieres WHERE id_matiere = :id_matiere";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':id_matiere', $id_matiere);
  $stmt->execute();
  $result_sous_matiere = $stmt->fetchAll();

  echo "<div class='container_sous_matieres' id='sous_matiere'>";
  foreach ($result_sous_matiere as $sous_matiere) {
    echo "<div class='sous_matieres'><a href='notes.php?matiere=".$id_matiere."&sous_matiere=".$sous_matiere['id_sous_matiere']."#note'><p>".$sous_matiere['nom_sous_matiere']."</p>". "</a></div>";
  }
}
?>
</div>

<?php

if ($id_sous_matiere != 0) {
  $sql = "SELECT * from notes WHERE id_sous_matiere = :id_sous_matiere AND id_user = :id_user";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':id_sous_matiere', $id_sous_matiere);
  $stmt->bindParam(':id_user', $_SESSION['id_user']);
  $stmt->execute();
  $result_notes = $stmt->fetchAll();

  echo "<div class='container_notes'>";
  foreach ($result_notes as $note) {
    echo "<div class='notes' id=note> <p>".$note['nom_note'] . "</p><p>" .$note['note']." / 20</p></div>";
  }
}
?>
</div>
</body>
<script src="scripts/burger.js"></script>
<script src="scripts/notes.js"></script>
</html>