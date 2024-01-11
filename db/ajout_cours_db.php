<?php 

session_start();

require ('../connexion/connexion.php');

$sql = "SELECT * FROM user WHERE id_user = :id_user AND id_fonction = 2 or id_fonction = 3";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id_user', $_SESSION['id_user'], PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) == 0) {
        echo '<h1>Vous n\'avez pas les droits pour accéder à cette page</h1>';
    } else {
        $id_sous_matiere = $_SESSION['id_sous_matiere'];
        $date = $_POST['date_cours'];
        $id_professeur = $_POST['professeur'];
        $id_salle = $_POST['salle'];
        $creneau = $_POST['creneau'];

        $sql = "INSERT INTO cours (id_cours, date_cours, id_professeur, id_salle, creneau_cours, id_sous_matiere) VALUES (NULL, :date_cours, :id_professeur, :id_salle, :creneau_cours, :id_matiere)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':date_cours', $date, PDO::PARAM_STR);
        $stmt->bindParam(':id_professeur', $id_professeur, PDO::PARAM_STR);
        $stmt->bindParam(':id_salle', $id_salle, PDO::PARAM_STR);
        $stmt->bindParam(':creneau_cours', $creneau, PDO::PARAM_STR);
        $stmt->bindParam(':id_matiere', $id_sous_matiere, PDO::PARAM_STR);
        $stmt->execute();

        header('Location: ../homepageprof.php');
    }



?>

