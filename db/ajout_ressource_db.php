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
        $nom_sous_matiere = $_POST['nouvelle_sous_matiere'];
        $id_matiere = $_SESSION['id_matiere'];

        $sql = "INSERT INTO sous_matieres (id_sous_matiere, nom_sous_matiere, id_matiere) VALUES (NULL, :nom_sous_matiere, :id_matiere)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':nom_sous_matiere', $nom_sous_matiere, PDO::PARAM_STR);
        $stmt->bindParam(':id_matiere', $id_matiere, PDO::PARAM_STR);
        $stmt->execute();

        header('Location: ../homepageprof.php');
    }



?>

