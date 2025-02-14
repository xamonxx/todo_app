<?php
require '../db/db_conn.php'; // Pastikan koneksi database

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id']) && isset($_GET['status'])) {
    $id = intval($_GET['id']);
    $new_status = ($_GET['status'] === 'completed') ? 'completed' : 'pending';

    // Update status di database
    $query = "UPDATE data_todo SET status = ? WHERE id_todo = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $new_status, $id);
    
    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false]);
    }
}
?>