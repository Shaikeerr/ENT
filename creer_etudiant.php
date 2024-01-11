<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un étudiant</title>
    <link rel="stylesheet" href="stylesheets/desktop/creer_etudiant.css">
    <link media="screen and (max-width: 600px)" rel="stylesheet" href="stylesheets/mobile/creer_etudiant_mobile.css">
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
    <form name="creer_etudiant" action="db/creer_etudiant_db.php" method="post">
        <a href="homepageperso.php"> 🡄 Retour</a>
        <h1>Créer un étudiant</h1>
        <input type="hidden" name="mot_de_passe" id="mot_de_passe" value=<?php echo genererMotDePasse(); ?>>

        <label for="mdp">Nom</label>
        <input type="text" name="nom" id="nom" required>
        <label for="mdp">Prénom</label>
        <input type="text" name="prenom" id="prenom" required>
        <label for="id_etudiant">Numéro Etudiant</label>
        <input type="text" name="id_etudiant" id="id_etudiant" required>

        <label for="formation">Formation</label>
        <select name="formation" id="formation">
            <?php 
            
            $sql = "SELECT * FROM formations";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $row) {
                echo "<option value=".$row['id_formation'].">".$row['nom_formation']."</option>";
            }

            ?>
        </select>


        </select>

        <input type="submit" value="Créer">
    </form>
</body>
</html>