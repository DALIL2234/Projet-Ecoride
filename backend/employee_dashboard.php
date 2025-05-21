<?php
session_start();
require 'config.php';

if ($_SESSION['role'] !== 'employee') {
    die("Accès refusé.");
}

$stmt = $pdo->query("SELECT * FROM reviews WHERE validated = 0");
$reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($reviews);
?>
