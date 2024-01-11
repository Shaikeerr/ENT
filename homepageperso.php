<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <link rel="stylesheet" href="stylesheets/navbar.css">
    <link rel="stylesheet" href="stylesheets/desktop/homepage.css">
    <link rel="stylesheet" href="stylesheets/desktop/homepageperso.css">
    <link media="screen and (max-width: 600px)" rel="stylesheet" href="stylesheets/mobile/homepageperso_mobile.css">
    <link rel="stylesheet" href="stylesheets/fonts.css">
</head>
<body>
    
<nav class="navbar">
        <a href="homepageperso.php" class="logo">
          <img src="images/logo.png" alt="accueil">
        </a>
        <img src="images/burger_icon.png" alt="burger" class="burger">
        <ul class="nav-links">
        <li class="nav-item"> <a href="inserer_menu.php"> Ajouter un menu</a> </li>
        <li class="nav-item"> <a href="ajout_absence.php"> Ajouter une absence</a> </li>   
        <li class="nav-item"> <a href="creer_prof.php"> Créer un prof</a> </li>
        <li class="nav-item"> <a href="creer_etudiant.php"> Creér un étudiant</a> </li>
        <li class="nav-item"> <a href="logout.php"> Déconnexion</a> </li>
        <?php 
        
        session_start();
      ?>
        </ul>
      </nav>


<div class="main">

<div class="grid">
  <div class="box_lien">
  <a href="inserer_menu.php">   <h2 class="emoji">🍴</h2><p>Créer un menu</p></a>
  </div>
  
  <div class="box_lien">
  <a href="ajout_absence.php"><h2 class="emoji"> 📅</h2><p> Ajouter une absence </p></a>
  </div>
  
  <div class="box_lien">
  <a href="creer_prof.php"> <h2 class="emoji"> 👨‍🏫</h2><p> Créer un prof </p></a>
  </div>
  
  <div class="box_lien">
  <a href="creer_etudiant.php"> <h2 class="emoji"> 👨‍🎓</h2><p> Créer un étudiant </p></a>
  </div>
</div>

</div>


</body>
<script src="scripts/burger.js"></script>
</html>