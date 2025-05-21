<?php
session_start();
if (!isset($_SESSION["utilisateur_id"])) {
    header("Location: backend/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["trajet_id"])) {
    $trajet_id = intval($_POST["trajet_id"]);
    $statut = $_POST["action"] === "start" ? "en cours" : "terminé";

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

    $stmt = $pdo->prepare("UPDATE rides SET statut = ?, date_statut = NOW() WHERE id = ? AND conducteur_id = ?");
    $stmt->execute([$statut, $trajet_id, $_SESSION["utilisateur_id"]]);

    header("Location: historique-covoiturages.php");
    exit();
}
?>
