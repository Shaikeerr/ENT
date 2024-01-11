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

        $nouveau_rendu = $_POST['nouveau_rendu'];
        $description = $_POST['description'];
        $date = $_POST['date'];
        $cours = $_POST['cours'];

        $sql = "INSERT INTO rendus (id_rendu, nom_rendu, date_rendu, id_matiere, description_rendu) VALUES (NULL, :nom_rendu, :date_rendu, :id_matiere, :description_rendu)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':nom_rendu', $nouveau_rendu, PDO::PARAM_STR);
        $stmt->bindParam(':date_rendu', $date, PDO::PARAM_STR);
        $stmt->bindParam(':id_matiere', $cours, PDO::PARAM_STR);
        $stmt->bindParam(':description_rendu', $description, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        header('Location: ../homepageprof.php');

    }
?>