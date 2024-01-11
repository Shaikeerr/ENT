<?php 
session_start(); 
require ('../connexion/connexion.php');

$sql = "SELECT * FROM professeurs ORDER BY id_professeur DESC LIMIT 1";
$stmt = $db->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);



$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$mot_de_passe = $_POST['mot_de_passe'];
$matiere = $_POST['matiere'];
$id_prof = $result[0]['id_professeur'] + 1;

$sql = "INSERT INTO user (id_user, identifiant, password, nom, prenom, id_fonction, id_etudiant, id_etablissement, id_formation, id_professeur) VALUES (NULL, '$nom.$prenom', '$mot_de_passe', '$nom', '$prenom', '2', NULL, '1', NULL, '$id_prof')";
$stmt = $db->prepare($sql);
$stmt->execute();

$sql = "INSERT INTO professeurs (id_professeur, nom_professeur, prenom_professeur) VALUES ('$id_prof', '$nom', '$prenom')";
$stmt = $db->prepare($sql);
$stmt->execute();

$sql = "INSERT INTO link_prof_matiere (id_link, id_professeur, id_matiere) VALUES (NULL, '$id_prof', '$matiere')";
$stmt = $db->prepare($sql);
$stmt->execute();


header('Location: ../homepageperso.php');
?>