<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <link rel="stylesheet" href="stylesheets/navbar.css">
    <link rel="stylesheet" href="stylesheets/homepage.css">
    <link rel="stylesheet" href="stylesheets/fonts.css">
</head>
<body>

<?php 

session_start();
require('connexion/connexion.php');
$date_actuelle = date("Y-m-d");

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

<div class="edt_container">
<h1>Cours du jour</h1>
<div class="edt">

<!--Début boîte 1-->

  <div class="container">
  <h3> <strong> 

  <?php  
  $sql = "SELECT matieres.nom_matiere FROM cours JOIN matieres ON cours.id_matiere = matieres.id_matiere WHERE date_cours = :date_actuelle AND creneau_cours = 1;";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':date_actuelle', $date_actuelle, PDO::PARAM_STR);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if (count($result) == 0) {
    echo '';
  } else {
  echo $result[0]['nom_matiere'];
  }
  ?>

  </strong> </h3>
  <p> 
  
  <?php 
  $sql = "SELECT professeurs.nom_professeur, professeurs.prenom_professeur FROM cours JOIN professeurs ON cours.id_professeur = professeurs.id_professeur WHERE date_cours = :date_actuelle AND creneau_cours = 1;";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':date_actuelle', $date_actuelle, PDO::PARAM_STR);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if (count($result) == 0) {
    echo '';
  } else {
  echo strtoupper($result[0]['nom_professeur']). " " . $result[0]['prenom_professeur'];
  }
  ?>

  </p>
  <p> 
    
  <?php 
  $sql = "SELECT salles.nom_salle FROM cours JOIN salles ON cours.id_salle = salles.id_salle WHERE date_cours = :date_actuelle AND creneau_cours = 1;";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':date_actuelle', $date_actuelle, PDO::PARAM_STR);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if (count($result) == 0) {
    echo '';
  } else {
  echo $result[0]['nom_salle'];
  }
  ?>

  </p>
  <p> 
  <?php 
  $sql = "SELECT creneau_cours FROM cours WHERE date_cours = :date_actuelle AND creneau_cours = 1;";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':date_actuelle', $date_actuelle, PDO::PARAM_STR);
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
  ?>
  </p>

  </div>

<!--Fin boîte 1-->

<!--Début boîte 2-->

  <div class="container">
  <h3> <strong> 

<?php  
$sql = "SELECT matieres.nom_matiere FROM cours JOIN matieres ON cours.id_matiere = matieres.id_matiere WHERE date_cours = :date_actuelle AND creneau_cours = 2;";
$stmt = $db->prepare($sql);
$stmt->bindParam(':date_actuelle', $date_actuelle, PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (count($result) == 0) {
  echo '';
} else {
echo $result[0]['nom_matiere'];
}
?>

</strong> </h3>
<p> 

<?php 
$sql = "SELECT professeurs.nom_professeur, professeurs.prenom_professeur FROM cours JOIN professeurs ON cours.id_professeur = professeurs.id_professeur WHERE date_cours = :date_actuelle AND creneau_cours = 2;";
$stmt = $db->prepare($sql);
$stmt->bindParam(':date_actuelle', $date_actuelle, PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (count($result) == 0) {
  echo '';
} else {
echo strtoupper($result[0]['nom_professeur']). " " . $result[0]['prenom_professeur'];
}
?>

</p>
<p> 
  
<?php 
$sql = "SELECT salles.nom_salle FROM cours JOIN salles ON cours.id_salle = salles.id_salle WHERE date_cours = :date_actuelle AND creneau_cours = 2;";
$stmt = $db->prepare($sql);
$stmt->bindParam(':date_actuelle', $date_actuelle, PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (count($result) == 0) {
  echo '';
} else {
echo $result[0]['nom_salle'];
}
?>

</p>
<p> 
<?php 
$sql = "SELECT creneau_cours FROM cours WHERE date_cours = :date_actuelle AND creneau_cours = 2;";
$stmt = $db->prepare($sql);
$stmt->bindParam(':date_actuelle', $date_actuelle, PDO::PARAM_STR);
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
?>
</p>
  </div>

<!--Fin boîte 2-->

  <h2> Repas </h2>

<!--Début boîte 3--> 
  <div class="container">
  <h3> <strong>
  <?php  
$sql = "SELECT matieres.nom_matiere FROM cours JOIN matieres ON cours.id_matiere = matieres.id_matiere WHERE date_cours = :date_actuelle AND creneau_cours = 3;";
$stmt = $db->prepare($sql);
$stmt->bindParam(':date_actuelle', $date_actuelle, PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (count($result) == 0) {
  echo '';
} else {
echo $result[0]['nom_matiere'];
}
?>

</strong> </h3>
<p> 

<?php 
$sql = "SELECT professeurs.nom_professeur, professeurs.prenom_professeur FROM cours JOIN professeurs ON cours.id_professeur = professeurs.id_professeur WHERE date_cours = :date_actuelle AND creneau_cours = 3;";
$stmt = $db->prepare($sql);
$stmt->bindParam(':date_actuelle', $date_actuelle, PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (count($result) == 0) {
  echo '';
} else {
echo strtoupper($result[0]['nom_professeur']). " " . $result[0]['prenom_professeur'];
}
?>

</p>
<p> 
  
<?php 
$sql = "SELECT salles.nom_salle FROM cours JOIN salles ON cours.id_salle = salles.id_salle WHERE date_cours = :date_actuelle AND creneau_cours = 3;";
$stmt = $db->prepare($sql);
$stmt->bindParam(':date_actuelle', $date_actuelle, PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (count($result) == 0) {
  echo '';
} else {
echo $result[0]['nom_salle'];
}
?>

</p>
<p> 
<?php 
$sql = "SELECT creneau_cours FROM cours WHERE date_cours = :date_actuelle AND creneau_cours = 3;";
$stmt = $db->prepare($sql);
$stmt->bindParam(':date_actuelle', $date_actuelle, PDO::PARAM_STR);
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
?>
</p>
  </div>

<!--Fin boîte 3-->

<!--Début boîte 4-->
  <div class="container">
  <h3> <strong>
<?php  
$sql = "SELECT matieres.nom_matiere FROM cours JOIN matieres ON cours.id_matiere = matieres.id_matiere WHERE date_cours = :date_actuelle AND creneau_cours = 4;";
$stmt = $db->prepare($sql);
$stmt->bindParam(':date_actuelle', $date_actuelle, PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (count($result) == 0) {
  echo '';
} else {
echo $result[0]['nom_matiere'];
}
?>

</strong> </h3>
<p> 

<?php 
$sql = "SELECT professeurs.nom_professeur, professeurs.prenom_professeur FROM cours JOIN professeurs ON cours.id_professeur = professeurs.id_professeur WHERE date_cours = :date_actuelle AND creneau_cours = 4;";
$stmt = $db->prepare($sql);
$stmt->bindParam(':date_actuelle', $date_actuelle, PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (count($result) == 0) {
  echo '';
} else {
echo strtoupper($result[0]['nom_professeur']). " " . $result[0]['prenom_professeur'];
}
?>

</p>
<p> 
  
<?php
$sql = "SELECT salles.nom_salle FROM cours JOIN salles ON cours.id_salle = salles.id_salle WHERE date_cours = :date_actuelle AND creneau_cours = 4;";
$stmt = $db->prepare($sql);
$stmt->bindParam(':date_actuelle', $date_actuelle, PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (count($result) == 0) {
  echo '';
} else {
echo $result[0]['nom_salle'];
}
?>

</p>
<p> 
<?php 
$sql = "SELECT creneau_cours FROM cours WHERE date_cours = :date_actuelle AND creneau_cours = 4;";
$stmt = $db->prepare($sql);
$stmt->bindParam(':date_actuelle', $date_actuelle, PDO::PARAM_STR);
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
?>
</p>
  </div>

<!--Fin boîte 4-->

</div>
</div>

</div>
    
</body>
</html>