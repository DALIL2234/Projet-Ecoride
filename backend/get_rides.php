<?php
require 'config.php';

$stmt = $pdo->query("SELECT * FROM rides WHERE seats_available > 0 ORDER BY ride_date ASC");
$rides = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($rides);
?>
