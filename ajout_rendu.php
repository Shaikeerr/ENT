<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel=stylesheet href="stylesheets/desktop/ajout_sous_matiere.css">
    <link media="screen and (max-width: 600px)" rel="stylesheet" href="stylesheets/mobile/ajout_sous_matiere_mobile.css">
    <link rel="stylesheet" href="stylesheets/fonts.css">
</head>
<body>
    




<?php
session_start();
require('connexion/connexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Si le formulaire de choix de formation a été soumis
    if (isset($_POST['formation'])) {
        $formation = $_POST['formation'];
        
        // Requête pour récupérer les matières de la formation sélectionnée
        $sql_matiere = "SELECT * FROM matieres JOIN link_prof_matiere ON matieres.id_matiere = link_prof_matiere.id_matiere WHERE link_prof_matiere.id_professeur = :id_prof  ORDER BY nom_matiere";
        $stmt_matiere = $db->prepare($sql_matiere);
        $stmt_matiere->bindParam(':id_prof', $_SESSION['id_professeur'], PDO::PARAM_STR);
        $stmt_matiere->execute();
        $result_matiere = $stmt_matiere->fetchAll(PDO::FETCH_ASSOC);



        echo '<form action="" method="POST">';
        echo '<a href="ajout_rendu.php">Retour</a>';
        echo '<h1>Choisissez une matière</h1>';
        echo '<select name="cours" id="cours">';

        if (count($result_matiere) > 0) {
            foreach ($result_matiere as $row) {
                echo "<option value='" . $row["id_matiere"] . "'>" . " " . $row["nom_matiere"] . "</option>";
    
                
            }
        } else {
            echo "<option value=''>Aucun élément trouvé</option>";
        }

        echo '</select>';
        echo '<input type="submit" value="Valider">';
        echo '</form>';
    }

    // Si le formulaire de choix de matière a été soumis
    elseif (isset($_POST['cours'])) {
        $cours = $_POST['cours'];
        $cours = intval($cours);
        $_SESSION['id_matiere'] = $cours;

        // Requête pour récupérer les informations de la matière sélectionnée
        $sql_matiere = "SELECT * FROM matieres WHERE id_matiere = :id_matiere";
        $stmt_matiere = $db->prepare($sql_matiere);
        $stmt_matiere->bindParam(':id_matiere', $cours, PDO::PARAM_STR);
        $stmt_matiere->execute();
        $result_matiere = $stmt_matiere->fetch(PDO::FETCH_ASSOC);

        // Affichage du formulaire d'ajout de cours

        echo '<form action="db/ajout_rendu_db.php" method="POST">';
        echo '<a href="ajout_rendu.php">Retour</a>';
        echo '<h1>Ajouter un rendu pour ' . $result_matiere["nom_matiere"] . '</h1>';
        echo '<input type="hidden" name="cours" value="' . $cours . '">';

        // Champ pour la nouvelle sous-matière
        echo '<label for="nouveau_rendu">Nom rendu</label>';
        echo '<input type="text" name="nouveau_rendu" id="nouveau_rendu">';
        echo '<label for="description">Description</label>';
        echo '<input type="text" name="description" id="description">';
        echo '<label for="date">Date</label>';
        echo '<input type="date" name="date" id="date">';

        echo '<input type="submit" value="Valider">';
        echo '</form>';
    }
}

// Si aucun formulaire n'a été soumis, afficher le formulaire de choix de formation
else {
    $sql = "SELECT * FROM user WHERE id_user = :id_user AND id_fonction = 2 or id_fonction = 3";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id_user', $_SESSION['id_user'], PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) == 0) {
        echo '<h1>Vous n\'avez pas les droits pour accéder à cette page</h1>';
    } else {
        $sql_formation = "SELECT * FROM formations";
        $stmt_formation = $db->prepare($sql_formation);
        $stmt_formation->execute();
        $result_formation = $stmt_formation->fetchAll(PDO::FETCH_ASSOC);
        echo '<form action="" method="POST">';
        echo '<a href="homepageprof.php">Retour</a>';
        echo '<h1>Choisissez une formation</h1>';
        
        echo '<select name="formation" id="formation">';
        if (count($result_formation) > 0) {
            foreach ($result_formation as $row_formation) {
                echo "<option value='" . $row_formation["id_formation"] . "'>" . $row_formation["nom_formation"] . "</option>";
            }
        } else {
            echo "<option value=''>Aucun élément trouvé</option>";
        }
        echo '</select>';
        echo '<input type="submit" value="Valider">';
        echo '</form>';
    }
}
?>

</body>
</html>
