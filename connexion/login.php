<?php
session_start();

include("connexion.php");

$username = $_POST["username"];
$password = $_POST["password"];
$fonction = $_POST["type"];


// Query to get the hashed password and id_user for the given username
$sql = "SELECT id_user, id_fonction, id_professeur, password FROM user WHERE identifiant = :username";
$stmt = $db->prepare($sql);
$stmt->bindParam(':username', $username);
$stmt->execute();
$userData = $stmt->fetch(PDO::FETCH_ASSOC);

// Verify the password
if ($userData && $password == $userData["password"] && $fonction == $userData["id_fonction"]) {
    $_SESSION["username"] = $username;
    $_SESSION["id_user"] = $userData["id_user"];
    $_SESSION["id_fonction"] = $fonction;


    if ($fonction == 1) {
        header("Location: ../homepage.php");
    } else if ($fonction == 2) {
        $_SESSION["id_professeur"] = $userData["id_professeur"];

        header("Location: ../homepageprof.php");
    } else if ($fonction == 3) {
        header("Location: ../homepageperso.php");

    }
} else {
    echo "Mot de passe ou pseudonyme incorrect";
}



$db = null;
?>
