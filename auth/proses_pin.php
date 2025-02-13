<?php
include '../db/db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_todo'];
    $pinned = $_POST['pinned'];

    $query = "UPDATE data_todo SET pinned = $pinned WHERE id_todo = $id";
    $result = mysqli_query($conn, $query);

    echo json_encode(['success' => $result]);
}
?>