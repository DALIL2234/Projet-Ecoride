<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    die("Non autorisé.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $start = htmlspecialchars($_POST['start']);
    $end = htmlspecialchars($_POST['end']);
    $date = $_POST['date'];
    $time = $_POST['time'];
    $price = $_POST['price'];
    $vehicle = htmlspecialchars($_POST['vehicle']);
    $seats = $_POST['seats'];
    $eco = isset($_POST['eco']) ? 1 : 0;

    $stmt = $pdo->prepare("INSERT INTO rides (driver_id, start_address, end_address, ride_date, ride_time, price, vehicle, seats_available, eco_friendly) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$_SESSION['user_id'], $start, $end, $date, $time, $price, $vehicle, $seats, $eco]);

    echo "Covoiturage ajouté avec succès.";
}
?>
