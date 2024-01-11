<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <link rel="stylesheet" href="stylesheets/navbar.css">
    <link rel="stylesheet" href="stylesheets/desktop/homepage.css">
    <link media="screen and (max-width: 600px)" rel="stylesheet" href="stylesheets/mobile/homepage_phone.css">
  
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

<div class="edt_container">
<h1>Cours du jour</h1>
<div class="edt">

<!--Début boîte 1-->

  <div class="container">
  <h3> <strong> 

  <?php  
  $sql = "SELECT sous_matieres.nom_sous_matiere FROM cours JOIN sous_matieres ON cours.id_sous_matiere = sous_matieres.id_sous_matiere WHERE cours.date_cours = :date_actuelle AND cours.creneau_cours = 1;";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':date_actuelle', $date_actuelle, PDO::PARAM_STR);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if (count($result) == 0) {
    echo '';
  } else {
  echo $result[0]['nom_sous_matiere'];
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
  $sql = "SELECT sous_matieres.nom_sous_matiere FROM cours JOIN sous_matieres ON cours.id_sous_matiere = sous_matieres.id_sous_matiere WHERE date_cours = :date_actuelle AND cours.creneau_cours = 2;";
$stmt = $db->prepare($sql);
$stmt->bindParam(':date_actuelle', $date_actuelle, PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (count($result) == 0) {
  echo '';
} else {
echo $result[0]['nom_sous_matiere'];
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
  $sql = "SELECT sous_matieres.nom_sous_matiere FROM cours JOIN sous_matieres ON cours.id_sous_matiere = sous_matieres.id_sous_matiere WHERE date_cours = :date_actuelle AND cours.creneau_cours = 3;";
$stmt = $db->prepare($sql);
$stmt->bindParam(':date_actuelle', $date_actuelle, PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (count($result) == 0) {
  echo '';
} else {
echo $result[0]['nom_sous_matiere'];
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
  $sql = "SELECT sous_matieres.nom_sous_matiere FROM cours JOIN sous_matieres ON cours.id_sous_matiere = sous_matieres.id_sous_matiere WHERE date_cours = :date_actuelle AND cours.creneau_cours = 4;";
$stmt = $db->prepare($sql);
$stmt->bindParam(':date_actuelle', $date_actuelle, PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (count($result) == 0) {
  echo '';
} else {
echo $result[0]['nom_sous_matiere'];
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


<div class="slideshow">
  
 <?php 
 
 $sql = "SELECT * FROM images_slideshow;";
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  echo '<div class="slides">';
  foreach ($result as $key => $value) {
    echo '<div class="slide">';
    $imageData = base64_encode($result[$key]['image_slideshow']);
    echo '<img src="data:image/jpeg;base64,'.$imageData.'" alt="Slideshow Image">';
    echo '</div>';
    }
    echo '</div>';
 ?>


  <div class="arrows">
    <div class="arrow arrow_left"><img class="" src="images/arrow-left.png"></div>
    <div class="arrow arrow_right"><img class="" src="images/arrow-right.png"></div>
  </div>
</div>



</div>
  
<div class="pages_link">
  <div class=last_rendu>
    <h2> Dernier rendu </h2>
    <?php
    $sql = "SELECT * FROM rendus JOIN matieres ON rendus.id_matiere = matieres.id_matiere;";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) == 0) {
      echo '<div class="element_last_rendu"> Aucun nouveau rendu </div>';
    } else {
    echo '<div class="element_last_rendu">';
    echo '<p>' . $result[0]['nom_matiere'] . '</p>';
    echo '<p>' . $result[0]['nom_rendu'] . '</p>';
    echo '<p>' . $result[0]['date_rendu'] . '</p>';
    }

    ?>
      <a href="rendus.php">Voir tous les rendus</a>
  </div>

  </div>

  <div class="last_notes">
    <h2> Dernière note </h2>
    <?php
    $sql = "SELECT * FROM notes JOIN user ON notes.id_user = user.id_user WHERE user.id_user = :id_user;";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id_user', $_SESSION['id_user'], PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) == 0) {
      echo '<div class="element_last_note"> Aucune nouvelle note';
    } else {
    echo '<div class="element_last_note">';
    echo '<p>' . $result[0]['nom_note'] . '</p>';
    
      $sql_matiere = "SELECT * from sous_matieres JOIN notes ON sous_matieres.id_sous_matiere = notes.id_sous_matiere WHERE notes.id_user = :id_user;";
      $stmt_matiere = $db->prepare($sql_matiere);
      $stmt_matiere->bindParam(':id_user', $_SESSION['id_user'], PDO::PARAM_STR);
      $stmt_matiere->execute();
      $result_matiere = $stmt_matiere->fetchAll(PDO::FETCH_ASSOC);
      echo '<p> Matière : ' . $result_matiere[0]['nom_sous_matiere'] . '</p>';
    echo '<p> Note : ' . $result[0]['note'] . ' / 20 </p>';
    }
    echo '<a href="notes.php">Voir toutes les notes</a>';
    echo '</div>';

    ?>
  </div>



  <div class="last_absences">
    <h2> Dernière absence </h2>
    <?php 
    
    $sql = "SELECT user.nom, user.prenom, absences.date_absence, absences.motif_absence FROM absences JOIN user ON absences.id_user = user.id_user WHERE user.id_user = :id_user ORDER BY absences.date_absence DESC LIMIT 1;";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id_user', $_SESSION['id_user'], PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($result) == 0) {
      echo '<div class="element_last_absence"> Aucune nouvelle absence';
    } else {
    echo '<div class="element_last_absence">';
    echo '<p> Date : ' . $result[0]['date_absence'] . '</p>';
    if ($result[0]['motif_absence'] == '') {
      echo '<p>Non justifiée</p>';
    } else {
      echo '<p>Justifiée</p> <p> Motif : ' . $result[0]['motif_absence'] . '</p>';
    }
    };
    echo '<a href="absences.php">Voir toutes les absences</a>';
    echo '</div>';
  


    ?>
  

  </div>
</div>
  </div>

</body>
<script src="scripts/slideshow.js"></script>
<script src="scripts/burger.js"></script>
</html>