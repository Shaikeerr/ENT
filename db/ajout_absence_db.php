<?php 

session_start();
require ('../connexion/connexion.php');
$etudiant = $_POST['etudiant'];

$sql = "SELECT * FROM user WHERE id_user = :id_user AND id_fonction = 2 or id_fonction = 3";
$stmt = $db->prepare($sql);
$stmt->bindParam(':id_user', $_SESSION['id_user'], PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($result) == 0) {
    echo '<h1>Vous n\'avez pas les droits pour accéder à cette page</h1>';
}
else {

    $etudiant = $_POST['etudiant'];
    $date_absence = $_POST['date_absence'];

    if (empty($_POST['motif_absence'])) {
        $motif_absence = NULL;
    }
    else {
        $motif_absence = $_POST['motif_absence'];
    }

    $heures_manquees = $_POST['heures_manquees'];

    $sql = "INSERT INTO absences (id_absence, id_user, motif_absence, date_absence, heures_manquees) VALUES (NULL, :id_user, :motif_absence, :date_absence, :heures_manquees)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id_user', $etudiant, PDO::PARAM_STR);
    $stmt->bindParam(':motif_absence', $motif_absence, PDO::PARAM_STR);
    $stmt->bindParam(':date_absence', $date_absence, PDO::PARAM_STR);
    $stmt->bindParam(':heures_manquees', $heures_manquees, PDO::PARAM_STR);
    $stmt->execute();

    header('Location: ../absences.php');

}

?>