<?php
session_start();

include("connexion.php");

$username = $_POST["username"];
$password = $_POST["password"];

// Query to get the hashed password and id_user for the given username
$sql = "SELECT id_user, password FROM user WHERE identifiant = :username";
$stmt = $db->prepare($sql);
$stmt->bindParam(':username', $username);
$stmt->execute();

// Fetch the result
$userData = $stmt->fetch();

// Verify the password
if ($userData && $password == $userData["password"]) {
    $_SESSION["username"] = $username;
    $_SESSION["id_user"] = $userData["id_user"];
    header("Location: ../homepage.php");
} else {
    echo "Mot de passe ou pseudonyme incorrect";
}

$db = null;
?>
