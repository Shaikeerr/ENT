<?php
require('connexion/connexion.php');

$selectedCantine = $_POST['cantines'];
$selectedDate = $_POST['date_menu'];
$entree = $_POST['entree'];
$plat = $_POST['plat'];
$dessert = $_POST['dessert'];

$sql = "INSERT INTO menu_cantines (id_menu, id_cantine, entree, plat, dessert, date_menu) VALUES (NULL, :selectedCantine, :entree, :plat, :dessert, :selectedDate)";
$stmt = $db->prepare($sql);
$stmt->bindParam(':selectedCantine', $selectedCantine, PDO::PARAM_STR);
$stmt->bindParam(':entree', $entree, PDO::PARAM_STR);
$stmt->bindParam(':plat', $plat, PDO::PARAM_STR);
$stmt->bindParam(':dessert', $dessert, PDO::PARAM_STR);
$stmt->bindParam(':selectedDate', $selectedDate, PDO::PARAM_STR);
$stmt->execute();

header('Location: restaurants.php?choix=' . $selectedCantine);
?>
