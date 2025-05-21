<?php
// Affiche les erreurs (mode dev)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connexion à la base de données
$host     = "localhost";
$dbname   = "ecoride";
$username = "root";
$password = "";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Traitement du formulaire d'inscription
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom            = trim($_POST["nom"]);
    $prenom         = trim($_POST["prenom"]);
    $date_naissance = $_POST["date_naissance"];
    $email          = trim($_POST["email"]);
    $mot_de_passe   = password_hash($_POST["mot_de_passe"], PASSWORD_DEFAULT);

    // 🔒 Vérification de la date de naissance
    $annee = (int)date('Y', strtotime($date_naissance));
    if ($annee < 1950 || $annee > 2020) {
        die("❌ La date de naissance doit être comprise entre 1950 et 2020.");
    }

    // Vérifie si l’e-mail est déjà utilisé
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM utilisateurs WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetchColumn() > 0) {
        die("❌ Cet email est déjà utilisé.");
    }

    // Insertion de l'utilisateur avec 20 crédits offerts
    $insert = $pdo->prepare("
        INSERT INTO utilisateurs 
            (nom, prenom, date_naissance, email, mot_de_passe, credits)
        VALUES 
            (:nom, :prenom, :date_naissance, :email, :mot_de_passe, :credits)
    ");
    $insert->execute([
        ":nom"            => $nom,
        ":prenom"         => $prenom,
        ":date_naissance" => $date_naissance,
        ":email"          => $email,
        ":mot_de_passe"   => $mot_de_passe,
        ":credits"        => 20
    ]);

    // Démarrage de session
    session_start();
    $utilisateur_id = $pdo->lastInsertId();
    $_SESSION["utilisateur_id"] = $utilisateur_id;
    $_SESSION["prenom"] = $prenom;
    $_SESSION["email"]  = $email;

    // Récupère les crédits
    $stmt = $pdo->prepare("SELECT credits FROM utilisateurs WHERE id = ?");
    $stmt->execute([$utilisateur_id]);
    $_SESSION["credits"] = $stmt->fetchColumn();

    // Message de confirmation
    echo "<!DOCTYPE html>
<html lang='fr'>
<head>
  <meta charset='UTF-8'>
  <meta http-equiv='refresh' content='3;url=dashboard.php'>
  <title>Inscription réussie</title>
  <style>
    body {
      background-color: #80e5ff;
      font-family: 'Nunito', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .box {
      background: white;
      padding: 2rem 3rem;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      text-align: center;
    }
    .box h2 {
      color: #2e7d32;
      font-size: 1.5rem;
    }
    .box p {
      font-size: 1rem;
      margin-top: 1rem;
    }
  </style>
</head>
<body>
  <div class='box'>
    <h2>✅ Inscription réussie !</h2>
    <p>Vous allez être redirigé vers votre espace personnel...</p>
  </div>
</body>
</html>";
    exit();
}
?>
