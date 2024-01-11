<?php 
session_start(); 
require ('../connexion/connexion.php');

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$id_etudiant = $_POST['id_etudiant'];
$formation = $_POST['formation'];
$mot_de_passe = $_POST['mot_de_passe'];

$sql = "INSERT INTO user (id_user, identifiant, password, nom, prenom, id_fonction, id_etudiant, id_etablissement, id_formation, id_professeur) VALUES (NULL, '$nom.$prenom', '$mot_de_passe', '$nom', '$prenom', '1', '$id_etudiant', '1', '$formation', NULL)";
$stmt = $db->prepare($sql);
$stmt->execute();

header('Location: ../homepageperso.php');
?>