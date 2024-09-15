<?php
include '../db.php'; 

if (isset($_POST['hire_id'])) {
    $hireId = $_POST['hire_id'];

    $stmt = $pdo->prepare('SELECT * FROM hires WHERE hire_id = :hire_id');
    $stmt->execute(['hire_id' => $hireId]);
    $hire = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($hire) {
        echo json_encode(['success' => true, 'data' => $hire]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
}
?>
