<?php
$host = 'localhost';
$db = 'ecoride_db';
$user = 'root';
$pass = ''; // Mets ton mot de passe si besoin (ex : 'root' sous MAMP)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
