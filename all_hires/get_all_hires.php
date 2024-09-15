<?php
include '../db.php'; 


$sql = "SELECT * FROM hires";
$stmt = $pdo->query($sql);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);


echo json_encode($results);
?>
