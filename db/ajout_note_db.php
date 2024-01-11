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
        
        $eleve = $_POST['eleve'];
        $note = $_POST['note'];
        $nom_note = $_POST['nouvelle_note'];
        $sous_matiere = $_POST['sous_matiere'];
        $coef = $_POST['coef'];

        $sql = "INSERT INTO notes (id_note, id_sous_matiere, nom_note, note, coefficient, id_user) VALUES (NULL, :id_sous_matiere, :nom_note, :note, :coef, :id_user)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id_sous_matiere', $sous_matiere, PDO::PARAM_STR);
        $stmt->bindParam(':nom_note', $nom_note, PDO::PARAM_STR);
        $stmt->bindParam(':note', $note, PDO::PARAM_STR);
        $stmt->bindParam(':coef', $coef, PDO::PARAM_STR);
        $stmt->bindParam(':id_user', $eleve, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        header('Location: ../homepageprof.php');
    }



?>

