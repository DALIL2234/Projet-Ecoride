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

$utilisateur_id = $_SESSION["utilisateur_id"];

$stmt = $pdo->prepare("
    SELECT r.*, t.ville_depart, t.ville_arrivee, t.date_depart, t.heure_depart
    FROM reservations r
    JOIN rides t ON r.trajet_id = t.id
    WHERE r.utilisateur_id = ?
    ORDER BY t.date_depart DESC
");
$stmt->execute([$utilisateur_id]);
$reservations = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mes réservations - EcoRide</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=NTR&family=Nunito&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Nunito', sans-serif;
      background-color: #80e5ff;
    }

    header {
      background-color: #b3f0ff;
      padding: 1rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-family: 'NTR', sans-serif;
    }

    .logo {
      font-size: 2rem;
      font-weight: bold;
      color: black;
      text-decoration: none;
    }

    .container {
      max-width: 800px;
      margin: 2rem auto;
      background: white;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 1.5rem;
    }

    .trajet {
      border-bottom: 1px solid #ccc;
      padding: 1rem 0;
    }

    .trajet:last-child {
      border-bottom: none;
    }

    .trajet strong {
      color: #45b58d;
    }
  </style>
</head>
<body>
  <header>
    <a href="dashboard.php" class="logo">ECORIDE</a>
    <div><a href="dashboard.php">Retour</a></div>
  </header>

  <div class="container">
    <h2>Mes réservations</h2>
    <?php if (count($reservations) === 0): ?>
      <p style="text-align:center;">Vous n'avez pas encore réservé de trajet.</p>
    <?php else: ?>
      <?php foreach ($reservations as $r): ?>
        <div class="trajet">
          <p><strong><?= htmlspecialchars($r["ville_depart"]) ?> ➝ <?= htmlspecialchars($r["ville_arrivee"]) ?></strong></p>
          <p>Date : <?= htmlspecialchars($r["date_depart"]) ?> à <?= htmlspecialchars($r["heure_depart"]) ?></p>
          <p>Réservé le : <?= htmlspecialchars(date("d/m/Y à H:i", strtotime($r["date_reservation"]))) ?></p>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</body>
</html>
