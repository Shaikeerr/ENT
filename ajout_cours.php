<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un cours</title>
    <link rel="stylesheet" href="stylesheets/desktop/ajout_cours.css">
    <link media="screen and (max-width: 600px)" rel="stylesheet" href="stylesheets/mobile/ajout_cours_mobile.css">
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
        $sql_cours = "SELECT * FROM matieres WHERE id_formation = :id_formation ORDER BY nom_matiere";
        $stmt_cours = $db->prepare($sql_cours);
        $stmt_cours->bindParam(':id_formation', $formation, PDO::PARAM_STR);
        $stmt_cours->execute();
        $result_cours = $stmt_cours->fetchAll(PDO::FETCH_ASSOC);

            $sql_sous_matiere = "SELECT * FROM sous_matieres WHERE id_matiere = :id_matiere ORDER BY nom_sous_matiere";
        $stmt_sous_matiere = $db->prepare($sql_sous_matiere);
        $stmt_sous_matiere->bindParam(':id_matiere', $cours, PDO::PARAM_STR);
        $stmt_sous_matiere->execute();
        $result_sous_matiere = $stmt_sous_matiere->fetchAll(PDO::FETCH_ASSOC);

echo '<form action="" method="POST">';
echo '<a href="ajout_cours.php">Retour</a>';
echo '<h1>Choisissez une matière</h1>';
echo '<select name="cours" id="cours">'; 

$sql_cours = "SELECT * FROM matieres JOIN link_prof_matiere ON matieres.id_matiere = link_prof_matiere.id_matiere WHERE link_prof_matiere.id_professeur = :id_prof  ORDER BY nom_matiere";
$stmt_cours = $db->prepare($sql_cours);
$stmt_cours->bindParam(':id_prof', $_SESSION['id_professeur'], PDO::PARAM_STR); 
$stmt_cours->execute();
$result_cours = $stmt_cours->fetchAll(PDO::FETCH_ASSOC);

if (count($result_cours) > 0) {
    foreach ($result_cours as $row) {
        echo "<option value='" . $row["id_matiere"] . "' disabled>" . "----- " . $row["nom_matiere"] . " -----</option>";

        $sql_sous_matiere = "SELECT * FROM sous_matieres WHERE id_matiere = :id_matiere ORDER BY nom_sous_matiere";
        $stmt_sous_matiere = $db->prepare($sql_sous_matiere);
        $stmt_sous_matiere->bindParam(':id_matiere', $row["id_matiere"], PDO::PARAM_STR);
        $stmt_sous_matiere->execute();
        $result_sous_matiere = $stmt_sous_matiere->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result_sous_matiere as $row_sous_matiere) {
            echo "<option value='" . $row_sous_matiere["id_sous_matiere"] . "'>" . $row_sous_matiere["nom_sous_matiere"] . "</option>";
        }
    }
} else {
    echo "<option value=''>Aucun élément trouvé</option>";
}


echo '</select>';
echo '<input type="submit" value="Valider">';
echo '</form>';



    }

    // Si le formulaire de choix d'étudiant a été soumis
    elseif (isset($_POST['cours'])) {
        $cours = $_POST['cours'];
        $cours = intval($cours);

        // Requête pour récupérer les informations de l'étudiant sélectionné
        $sql_cours = "SELECT * FROM sous_matieres JOIN matieres ON sous_matieres.id_matiere = matieres.id_matiere WHERE id_sous_matiere = :id_matiere";
        $stmt_cours = $db->prepare($sql_cours);
        $stmt_cours->bindParam(':id_matiere', $cours, PDO::PARAM_STR);
        $stmt_cours->execute();
        $result_cours = $stmt_cours->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['id_sous_matiere'] = $result_cours[0]["id_sous_matiere"];



        echo '<input type="hidden" name="id_sous_matiere" value="' . $result_cours[0]["id_sous_matiere"] . '">';
        echo '<form action="db/ajout_cours_db.php" method="POST">';
        echo '<a href="ajout_cours.php">Retour</a>';
        echo '<h1>Ajouter un cours pour ' . $result_cours[0]["nom_sous_matiere"] . '</h1>';
        echo '<label for="date_cours">Date du cours</label>';
        echo '<input type="date" name="date_cours" id="date_cours">';
        echo '<label for="professeur">Professeur</label>';
        echo '<select name="professeur" id="professeur">';
        $sql_professeur = "SELECT * FROM professeurs JOIN link_prof_matiere ON link_prof_matiere.id_professeur = professeurs.id_professeur JOIN matieres ON link_prof_matiere.id_matiere = matieres.id_matiere JOIN sous_matieres ON matieres.id_matiere = sous_matieres.id_matiere WHERE sous_matieres.id_sous_matiere = :id_matiere";
        $stmt_professeur = $db->prepare($sql_professeur);
        $stmt_professeur->bindParam(':id_matiere', $cours, PDO::PARAM_STR); 
        $stmt_professeur->execute();
        $result_professeur = $stmt_professeur->fetchAll(PDO::FETCH_ASSOC);

        if (count($result_professeur) > 0) {
            foreach ($result_professeur as $row) {
                echo "<option value='" . $row["id_professeur"] . "'>" . strtoupper($row["nom_professeur"]) . ' ' . $row["prenom_professeur"] . "</option>";
            }
        } else {
            echo "<option value=''>Aucun élément trouvé</option>";
        }
        echo '</select>';

        echo '<label for="salle">Salle</label>';
        echo '<select name="salle" id="salle">';
        $sql_salle = "SELECT * FROM salles";
        $stmt_salle = $db->prepare($sql_salle);
        $stmt_salle->execute();
        $result_salle = $stmt_salle->fetchAll(PDO::FETCH_ASSOC);

        if (count($result_salle) > 0) {
            foreach ($result_salle as $row) {
                echo "<option value='" . $row["id_salle"] . "'>" . $row["nom_salle"] . "</option>";
            }
        } else {
            echo "<option value=''>Aucun élément trouvé</option>";
        }
        echo '</select>';

        echo '<h2>Créneaux Horaire</h2>';
        echo '<label for="creneau1">08h15 - 10h30</label>';
        echo '<input type="radio" name="creneau" id="creneau1" value="1"><br>';
        echo '<label for="creneau2">10h30 - 12h30</label>';
        echo '<input type="radio" name="creneau" id="creneau2" value="2"><br>';
        echo '<label for="creneau3">13h30 - 15h30</label>';
        echo '<input type="radio" name="creneau" id="creneau3" value="3"><br>';
        echo '<label for="creneau4">15h45 - 17h45</label>';
        echo '<input type="radio" name="creneau" id="creneau4" value="4"><br>';

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
