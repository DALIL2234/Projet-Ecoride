<?php
session_start();
if (!isset($_SESSION["utilisateur_id"])) {
    header("Location: backend/login.php");
    exit();
}

$utilisateur_id = $_SESSION["utilisateur_id"];

$host = "localhost";
$dbname = "ecoride";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérifie que les champs sont bien reçus
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $modele = trim($_POST["modele"]);
    $couleur = trim($_POST["couleur"]);
    $plaque = trim($_POST["plaque"]);
    $date_immat = $_POST["date_immat"];
    $places = intval($_POST["places"]);
    $electrique = $_POST["electrique"];

    // Insérer dans la base
    $stmt = $pdo->prepare("INSERT INTO vehicules (utilisateur_id, modele, couleur, plaque, date_immat, places, electrique)
                           VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$utilisateur_id, $modele, $couleur, $plaque, $date_immat, $places, $electrique]);

    header("Location: ajouter-vehicule.php");
    exit();
}
?>
