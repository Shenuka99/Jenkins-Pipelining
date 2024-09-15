<?php
include '../db.php';

$stmt = $pdo->prepare("SELECT * FROM hires WHERE distance > 5");
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($results);
?>
