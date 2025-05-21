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

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["vehicule"])) {
    $vehicule_id = intval($_POST["vehicule"]);

    // Vérifie que le véhicule appartient à l'utilisateur
    $check = $pdo->prepare("SELECT COUNT(*) FROM vehicules WHERE id = ? AND utilisateur_id = ?");
    $check->execute([$vehicule_id, $utilisateur_id]);
    if ($check->fetchColumn() > 0) {
        // Enregistrer le véhicule sélectionné dans la session
        $_SESSION["vehicule_actif"] = $vehicule_id;

        // Optionnel : en base si on veut le stocker de façon persistante
        $stmt = $pdo->prepare("UPDATE utilisateurs SET vehicule_actif = ? WHERE id = ?");
        $stmt->execute([$vehicule_id, $utilisateur_id]);
    }
}

header("Location: ajouter-vehicule.php");
exit();
?>
