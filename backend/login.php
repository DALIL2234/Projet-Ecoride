<?php
session_start(); // On démarre la session pour pouvoir stocker les infos utilisateur

// Active l'affichage des erreurs (utile en développement)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Connexion à la base de données
$host = "localhost";
$dbname = "ecoride";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

$message = "";

// Traitement du formulaire envoyé
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // On récupère les infos soumises par l'utilisateur
    $email = trim($_POST["email"]);
    $mot_de_passe = $_POST["mot_de_passe"];

    // Requête pour vérifier si un utilisateur avec cet email existe
    $sql = "SELECT * FROM utilisateurs WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([":email" => $email]);
    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si on a bien trouvé un utilisateur et que le mot de passe est correct
    if ($utilisateur && password_verify($mot_de_passe, $utilisateur["mot_de_passe"])) {
        // On stocke les infos de l'utilisateur dans la session
        $_SESSION["utilisateur_id"] = $utilisateur["id"];
        $_SESSION["nom"] = $utilisateur["nom"];
        $_SESSION["prenom"] = $utilisateur["prenom"]; // 🆕 Ajouté pour affichage personnalisé
        $_SESSION["email"] = $utilisateur["email"];   // 🆕 Ajouté pour affichage
        $_SESSION["role"] = $utilisateur["role"] ?? "passager";

        // 🔑 On récupère les crédits pour l'utilisateur
        $stmt = $pdo->prepare("SELECT credits FROM utilisateurs WHERE id = ?");
        $stmt->execute([$_SESSION["utilisateur_id"]]);
        $_SESSION["credits"] = $stmt->fetchColumn();

        // On affiche une page de confirmation et on redirige vers dashboard.php
        echo "<!DOCTYPE html>
        <html lang='fr'>
        <head>
            <meta charset='UTF-8'>
            <meta http-equiv='refresh' content='2;url=../dashboard.php'>
            <title>Connexion réussie</title>
            <style>
                body {
                    background-color: #80e5ff;
                    font-family: 'Nunito', sans-serif;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                }
                .box {
                    background: white;
                    padding: 2rem;
                    border-radius: 10px;
                    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                    text-align: center;
                }
                .box h2 {
                    color: #2e7d32;
                }
            </style>
        </head>
        <body>
            <div class='box'>
                <h2>✅ Connexion réussie !</h2>
                <p>Redirection vers votre tableau de bord...</p>
            </div>
        </body>
        </html>";
        exit();
    } else {
        // Sinon, identifiants incorrects
        $message = "❌ Email ou mot de passe incorrect.";
    }
}
?>
