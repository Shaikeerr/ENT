<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un professeur</title>
    <link rel="stylesheet" href="stylesheets/desktop/creer_prof.css">
    <link media="screen and (max-width: 600px)" rel="stylesheet" href="stylesheets/mobile/creer_prof_mobile.css">
    <link rel="stylesheet" href="stylesheets/fonts.css">
</head>
<body>
    <?php 
    
    session_start();
    require ('connexion/connexion.php');

    function genererMotDePasse($longueur = 8) {
        // Caractères autorisés dans le mot de passe
        $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    
        // Générer un mot de passe aléatoire
        $motDePasse = '';
        for ($i = 0; $i < $longueur; $i++) {
            $motDePasse .= $caracteres[random_int(0, strlen($caracteres) - 1)];
        }
    
        return $motDePasse;
    }
    
    ?>
    <form name="creer_prof" action="db/creer_prof_db.php" method="post">
        <a href="homepageperso.php"> 🡄 Retour</a>
        <h1>Créer un professeur</h1>
        <input type="hidden" name="mot_de_passe" id="mot_de_passe" value=<?php echo genererMotDePasse(); ?>>
        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" required>
        <label for="prenom">Prénom</label>
        <input type="text" name="prenom" id="prenom" required>
        <label for="matiere">Matière</label>
        <select name="matiere" id="matiere">

            <?php 
            
            $sql = "SELECT * FROM matieres";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $row) {
                echo "<option value=".$row['id_matiere'].">".$row['nom_matiere']."</option>";
            }

            ?>
        </select>


        </select>

        <input type="submit" value="Créer">
    </form>
</body>
</html>