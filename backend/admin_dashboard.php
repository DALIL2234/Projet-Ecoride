<?php
session_start();
require 'config.php';

if ($_SESSION['role'] !== 'admin') {
    die("Accès refusé.");
}

$rides = $pdo->query("SELECT COUNT(*) FROM rides")->fetchColumn();
$credits = $pdo->query("SELECT SUM(credits) FROM users")->fetchColumn();

echo json_encode([
    'rides_total' => $rides,
    'credits_total' => $credits
]);
?>
