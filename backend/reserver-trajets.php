<?php
session_start();
if (!isset($_SESSION["utilisateur_id"])) {
    header("Location: login.php");
    exit();
}

$host = "localhost";
$dbname = "ecoride";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["trajet_id"])) {
    $utilisateur_id = $_SESSION["utilisateur_id"];
    $trajet_id = $_POST["trajet_id"];

    // Vérifie que le trajet existe
    $stmt = $pdo->prepare("SELECT * FROM rides WHERE id = ?");
    $stmt->execute([$trajet_id]);
    $trajet = $stmt->fetch();

    if (!$trajet) {
        die("❌ Trajet introuvable.");
    }

    // Villes d'Île-de-France
    $idf_villes = [
        "Paris", "Versailles", "Créteil", "Nanterre", "Boulogne-Billancourt",
        "Saint-Denis", "Evry", "Argenteuil", "Montreuil", "Aulnay-sous-Bois"
    ];

    $depart = $trajet["ville_depart"];
    $arrivee = $trajet["ville_arrivee"];

    // Calcul des crédits
    if (in_array($depart, $idf_villes) && in_array($arrivee, $idf_villes)) {
        $tarif_credits = 4;
    } else {
        $tarif_credits = 20;
    }

    // Vérifie le solde de l'utilisateur
    $stmt = $pdo->prepare("SELECT credits FROM utilisateurs WHERE id = ?");
    $stmt->execute([$utilisateur_id]);
    $utilisateur = $stmt->fetch();

    if ($utilisateur["credits"] < $tarif_credits) {
        die("❌ Crédit insuffisant. Il vous faut $tarif_credits crédits.");
    }

    // Vérifie si déjà réservé
    $check = $pdo->prepare("SELECT COUNT(*) FROM reservations WHERE utilisateur_id = ? AND trajet_id = ?");
    $check->execute([$utilisateur_id, $trajet_id]);
    if ($check->fetchColumn() > 0) {
        die("❌ Vous avez déjà réservé ce trajet.");
    }

    // Déduit les crédits
    $stmt = $pdo->prepare("UPDATE utilisateurs SET credits = credits - ? WHERE id = ?");
    $stmt->execute([$tarif_credits, $utilisateur_id]);

    // Enregistre la réservation
    $stmt = $pdo->prepare("INSERT INTO reservations (utilisateur_id, trajet_id) VALUES (?, ?)");
    $stmt->execute([$utilisateur_id, $trajet_id]);

    echo "<h2 style='text-align:center;font-family:sans-serif;'>✅ Réservation confirmée ! $tarif_credits crédits déduits.</h2>";
    echo "<p style='text-align:center;'><a href='dashboard.php'>Retour au tableau de bord</a></p>";
}
?>
