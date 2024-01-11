<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une absence</title>
    <link rel="stylesheet" href="stylesheets/desktop/ajout_absence.css">
    <link media="screen and (max-width: 600px)" rel="stylesheet" href="stylesheets/mobile/ajout_absence_mobile.css">
    <link rel="stylesheet" href="stylesheets/fonts.css">
</head>
<body>

<?php
session_start();
require ('connexion/connexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Si le formulaire de choix de formation a été soumis
    if (isset($_POST['formation'])) {
        $formation = $_POST['formation'];

        // Requête pour récupérer les étudiants de la formation sélectionnée
        $sql_etudiant = "SELECT * FROM user WHERE id_formation = :id_formation ORDER BY nom";
        $stmt_etudiant = $db->prepare($sql_etudiant);
        $stmt_etudiant->bindParam(':id_formation', $formation, PDO::PARAM_STR);
        $stmt_etudiant->execute();
        $result_etudiant = $stmt_etudiant->fetchAll(PDO::FETCH_ASSOC);

        echo '<form action="" method="POST">';
        echo '<a href="ajout_absence.php">Retour</a>';
        echo '<h1>Choisissez un étudiant</h1>';
        echo '<select name="etudiant" id="etudiant">';
        if (count($result_etudiant) > 0) {
            foreach ($result_etudiant as $row) {
                echo "<option value='" . $row["id_user"] . "'>" . $row["nom"] . " " . $row["prenom"] . "</option>";
            }
        } else {
            echo "<option value=''>Aucun élément trouvé</option>";
        }
        echo '</select>';
        echo '<input type="submit" value="Valider">';
        echo '</form>';


    }

    // Si le formulaire de choix d'étudiant a été soumis
    elseif (isset($_POST['etudiant'])) {
        $etudiant = $_POST['etudiant'];

        // Requête pour récupérer les informations de l'étudiant sélectionné
        $sql_etudiant = "SELECT * FROM user WHERE id_user = :id_user";
        $stmt_etudiant = $db->prepare($sql_etudiant);
        $stmt_etudiant->bindParam(':id_user', $etudiant, PDO::PARAM_STR);
        $stmt_etudiant->execute();
        $result_etudiant = $stmt_etudiant->fetchAll(PDO::FETCH_ASSOC);


        echo '<form action="db/ajout_absence_db.php" method="POST">';
        echo '<a href="ajout_absence.php">Retour</a>';
        echo '<h1>Ajouter une absence pour ' . $result_etudiant[0]["nom"] . ' ' . $result_etudiant[0]["prenom"] . '</h1>';
        echo '<input type="hidden" name="etudiant" value="' . $etudiant . '">';
    echo '<label for="date_absence"><h2>Date de l\'absence</h2></label>';
        echo '<input type="date" name="date_absence" id="date_absence">';
        echo '<label for="motif_absence"><h2>Motif de l\'absence</h2></label>';
        echo '<input type="text" name="motif_absence" id="motif_absence" placeholder="Motif de l\'absence">';
        echo '<label for heures_manquees"><h2>Heures manquées</h2></label>';
        echo '<input type="number" name="heures_manquees" id="heures_manquees" placeholder="Heures manquées">';
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
        echo '<a href="homepageperso.php">Retour</a>';
        echo '<h1>Choisissez une formation</h1>';
        
        echo '<select name="formation" id="formation">';
        if (count($result_formation) > 0) {
            foreach ($result_formation as $row) {
                echo "<option value='" . $row["id_formation"] . "'>" . $row["nom_formation"] . "</option>";
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
