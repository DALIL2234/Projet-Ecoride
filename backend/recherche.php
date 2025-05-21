<?php
$host = "localhost";
$dbname = "ecoride";
$username = "root";
$password = "root"; // Utilise "root" sur Mac avec MAMP

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $date_naissance = $_POST["date_naissance"];
    $email = $_POST["email"];
    $mot_de_passe = password_hash($_POST["mot_de_passe"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO utilisateurs (nom, prenom, date_naissance, email, mot_de_passe) 
            VALUES (:nom, :prenom, :date_naissance, :email, :mot_de_passe)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ":nom" => $nom,
        ":prenom" => $prenom,
        ":date_naissance" => $date_naissance,
        ":email" => $email,
        ":mot_de_passe" => $mot_de_passe
    ]);

    // Redirection après inscription
    header("Location: ../public/covoiturages.html");
    exit();
}
?>
