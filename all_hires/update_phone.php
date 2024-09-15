<?php
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $hire_id = $_POST['hire_id'];
    $new_phone = $_POST['customer_phone'];

    
    $sql = "UPDATE hires SET customer_phone = :customer_phone WHERE hire_id = :hire_id";
    $stmt = $pdo->prepare($sql);


    $stmt->execute(['customer_phone' => $new_phone, 'hire_id' => $hire_id]);

    echo "Phone number updated successfully";
}
?>
