<?php 
    require('connexion/connexion.php');
    $sql = "SELECT * FROM cantines";   
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $dateActuelle = date('Y-m-d');

    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurants</title>
    <link rel="stylesheet" href="stylesheets/restaurants.css">
    <link rel="stylesheet" href="stylesheets/navbar.css">
    <link rel="stylesheet" href="stylesheets/fonts.css">
</head>

<body>
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
<div class="boutons_choix">
<a href="restaurants.php?choix=1">L'Arlequin</a>
    <a href="restaurants.php?choix=2">Caféréria IUT</a>
    <a href="restaurants.php?choix=3">ESIEE</a>
</div>

<div class="restaurant">
    <?php 
        $choix = $_GET['choix'];

        $frequentation = "SELECT AVG(etat_frequentation) AS moyenne_frequentation FROM frequentation WHERE id_cantine = $choix AND DATE(date_frequentation) = :dateActuelle";
        $stmt = $db->prepare($frequentation);
        $stmt->bindParam(':dateActuelle', $dateActuelle, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $moyenne = $result[0]["moyenne_frequentation"];
        $moyenne = round($moyenne, 0);

        $choix = intval($choix);
        $sql = "SELECT * FROM cantines WHERE id_cantine = $choix";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $result_cantine = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo '<div class="infos_cantine">';
        echo '<p>'.$result_cantine[0]["nom_cantine"].'</p>';
        echo '<p>'. $result_cantine[0]["lieu_cantine"].'</p>';
        echo '</div>';
        echo '<div class="separator">';
        echo '</div>';
        echo '<div class="frequentation_cantine">';
        ?>

            <style> 

            progress::-webkit-progress-value {
                    background-color: <?php
                        if ($moyenne >= 1 && $moyenne <= 4) {
                            $colors = [1 => 'green', 2 => 'yellow', 3 => 'orange', 4 => 'red'];
                            echo $colors[$moyenne];
                        } else {
                            echo 'gray';
                        }
                    ?>;
                }

            </style>


    <?php
        echo '<p>Fréquentation : ';
                switch ($moyenne) {
                    case 1:
                        echo 'Faible</p>';
                        break;
                    case 2:
                        echo 'Moyenne</p>';
                        break;
                    case 3:
                        echo 'Élevée</p>';
                        break;
                    case 4:
                        echo 'Très élevée</p>';
                        break;
                    default:
                        echo 'Non définie</p>';
                }
?>

                <progress id="file" max="100" value="<?php echo $moyenne * 25 ?>"></progress>
    <a href="soumettre_frequentation.php">Soumettre une fréquentation</a>
</div>
</div>

<div class="menu_cantine">
    <?php 
        $sql_menu = "SELECT * FROM menu_cantines WHERE id_cantine = $choix AND DATE(date_menu) = :dateActuelle";
        $stmt = $db->prepare($sql_menu);
        $stmt->bindParam(':dateActuelle', $dateActuelle, PDO::PARAM_STR);
        $stmt->execute();
        $result_menu = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    ?>


    <h2>Menu du jour</h2>
    <div class="menu">
        <div class="entree">
            <h3>Entrée</h3>
            <p><?php 
            if (empty($result_menu)) {
                echo 'Non définie';
            } else {
                echo $result_menu[0]["entree"];
            } ?></p>
        </div>
        <div class="plat">
            <h3>Plat</h3>
            <p><?php
            if (empty($result_menu)) {
                echo 'Non défini';
            } else {
                echo $result_menu[0]["plat"];
            } ?></p>
        </div>
        <div class="dessert">
            <h3>Dessert</h3>
            <p><?php 
            if (empty($result_menu)) {
                echo 'Non défini';
            } else {
                echo $result_menu[0]["dessert"];
            } ?></p>
        </div>
    </div>
</div>


</div>
</body>
</html>



