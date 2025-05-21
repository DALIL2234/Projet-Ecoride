<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION['role'] == 'employee') {
    $review_id = $_POST['review_id'];
    $validate = $_POST['validate'];

    $stmt = $pdo->prepare("UPDATE reviews SET validated = ? WHERE id = ?");
    $stmt->execute([$validate, $review_id]);

    echo "Avis mis à jour.";
}
?>
