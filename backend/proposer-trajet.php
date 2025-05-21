<?php
session_start();
if (!isset($_SESSION["utilisateur_id"])) {
    header("Location: backend/login.php");
    exit();
}

$utilisateur_id = $_SESSION["utilisateur_id"];
$vehicule_id = $_SESSION["vehicule_actif"] ?? null;

if (!$vehicule_id) {
    die("❌ Aucun véhicule actif sélectionné. Veuillez en sélectionner un avant de publier un trajet.");
}

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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $depart = $_POST["depart"];
    $arrivee = $_POST["arrivee"];
    $date = $_POST["date"];
    $heure = $_POST["heure"];
    $places = intval($_POST["places"]);
    $prix = floatval($_POST["prix"]);
    $animaux = $_POST["animaux"];
    $fumeur = $_POST["fumeur"];

    // Retire 2 crédits à l'utilisateur pour la plateforme
    $stmt = $pdo->prepare("SELECT credits FROM utilisateurs WHERE id = ?");
    $stmt->execute([$utilisateur_id]);
    $credits = $stmt->fetchColumn();

    if ($credits < 2) {
        die("❌ Vous n'avez pas assez de crédits pour publier un trajet.");
    }

    $pdo->beginTransaction();

    try {
        // Enregistrement du trajet
        $stmt = $pdo->prepare("INSERT INTO rides (conducteur_id, vehicule_id, ville_depart, ville_arrivee, date_depart, heure_depart, places_disponibles, prix, animaux, fumeur)
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$utilisateur_id, $vehicule_id, $depart, $arrivee, $date, $heure, $places, $prix, $animaux, $fumeur]);

        // Mise à jour des crédits
        $stmt = $pdo->prepare("UPDATE utilisateurs SET credits = credits - 2 WHERE id = ?");
        $stmt->execute([$utilisateur_id]);

        $pdo->commit();
        echo "<h2 style='text-align:center;'>✅ Trajet publié avec succès !</h2>";
        echo "<p style='text-align:center;'><a href='dashboard.php'>Retour au tableau de bord</a></p>";
    } catch (Exception $e) {
        $pdo->rollBack();
        die("❌ Erreur lors de la publication du trajet : " . $e->getMessage());
    }
}
?>
