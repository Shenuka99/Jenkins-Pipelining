<?php
require_once '../db.php';

$start_lat = $_POST['start_lat'];
$start_lon = $_POST['start_lon'];
$end_lat = $_POST['end_lat'];
$end_lon = $_POST['end_lon'];
$distance = $_POST['distance'];
$hire_amount = $_POST['hire_amount'];
$customer_phone = $_POST['customer_phone'];

try {
    $stmt = $pdo->prepare("INSERT INTO hires (start_lat, start_lon, end_lat, end_lon, distance, hire_amount, customer_phone) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$start_lat, $start_lon, $end_lat, $end_lon, $distance, $hire_amount, $customer_phone]);
    echo 'Success';
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
