<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <link rel="stylesheet" href="stylesheets/navbar.css">
    <link rel="stylesheet" href="stylesheets/desktop/homepage.css">
    <link rel="stylesheet" href="stylesheets/desktop/homepageprof.css">
    <link media="screen and (max-width: 600px)" rel="stylesheet" href="stylesheets/mobile/homepageprof_mobile.css">
    <link rel="stylesheet" href="stylesheets/fonts.css">
</head>
<body>
    
<nav class="navbar">
        <a href="homepageprof.php" class="logo">
          <img src="images/logo.png" alt="accueil">
        </a>
        <img src="images/burger_icon.png" alt="burger" class="burger">
        <ul class="nav-links">
        <li class="nav-item"> <a href="ajout_cours.php"> Ajouter un cours</a> </li>
        <li class="nav-item"> <a href="ajout_ressource.php"> Ajouter une ressource</a> </li>   
        <li class="nav-item"> <a href="ajout_rendu.php"> Ajouter un rendu</a> </li>
        <li class="nav-item"> <a href="ajout_notes.php"> Ajouter une note</a> </li>
        <li class="nav-item"> <a href="calendrier.php"> Calendrier</a> </li>
        <li class="nav-item"> <a href="logout.php"> Déconnexion</a> </li>
        <?php 
        
        session_start();
      ?>
        </ul>
      </nav>


<div class="main">

<div class="grid">
  <div class="box_lien">

  <a href="ajout_cours.php">   <h2 class="emoji">📚</h2> <p> Ajouter un cours </p></a>
  </div>
  
  <div class="box_lien">
  <a href="ajout_ressource.php"><h2 class="emoji">📂</h2> <p> Ajouter une ressource </p></a>
  </div>
  
  <div class="box_lien">
  <a href="ajout_rendu.php"> <h2 class="emoji">⏱️</h2> <p> Ajouter un rendu </p></a>
  </div>
  
  <div class="box_lien">
  <a href="ajout_notes.php"> <h2 class="emoji">📝</h2> <p> Ajouter une note </p></a>
  </div>
</div>

</div>


</body>
<script src="scripts/burger.js"></script>
</html>