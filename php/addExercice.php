<?php
// Connexion à la base de données
// script php tente de se connecter a base donnée SQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smarteats";

// Création de l'objet PDO et connexion à la base de données
//creation nouvelle instance classe PDO 
// type base de donnée mysql
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Configure PDO pour générer des exceptions en cas d'erreur
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérifier si toutes les données requises sont présentes dans $_POST
if (isset($_POST['name']) && isset($_POST['duree_exo']) && isset($_POST['description_exo']) && isset($_POST['objectif_exo'])  && isset($_POST['image_url3']) ) {
    // Récupérer les données du formulaire
 
    $name = $_POST['name'];
    $duree_exo = $_POST['duree_exo'];
    $description_exo = $_POST['description_exo'];
    $objectif_exo = $_POST['objectif_exo'];
    $image_url3 = $_POST['image_url3'] ?? '';

    // Préparer la requête pour mettre à jour l'exercice
    $stmt = $pdo->prepare("INSERT INTO `exercice` (`nom`, `duree`, `descript`, `objectif`, `image_url`) VALUES (?, ?, ?, ?, ?)");


    // Exécuter la requête avec les données du formulaire
    if ($stmt->execute([$name, $duree_exo, $description_exo, $objectif_exo,$image_url3])) {
        // Si la requête s'exécute avec succès, renvoyer un statut JSON "success"
        echo json_encode(["status" => "success"]);
    } else {
        // Sinon, renvoyer un statut JSON "error"
        echo json_encode(["status" => "error"]);
    }
} else {
    // Si les données requises ne sont pas présentes, renvoyer un statut JSON "error"
    echo json_encode(["status" => "error"]);
}
?>
