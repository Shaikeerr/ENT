<?php

require('../connexion/connexion.php');

$selectedCantine = $_POST['cantine'];
$selectedFreq = $_POST['freq'];
$dateActuelle = date('Y-m-d');

$sql = "INSERT INTO frequentation (id_frequentation, id_user, id_cantine, date_frequentation, etat_frequentation) VALUES (NULL, 1, :selectedCantine, :dateActuelle ,:selectedFreq)";
$stmt = $db->prepare($sql);
$stmt->bindParam(':selectedCantine', $selectedCantine, PDO::PARAM_STR);
$stmt->bindParam(':dateActuelle', $dateActuelle, PDO::PARAM_STR);
$stmt->bindParam(':selectedFreq', $selectedFreq, PDO::PARAM_STR);
$stmt->execute();

header('Location: ../restaurants.php?choix='.$selectedCantine.'');
?>