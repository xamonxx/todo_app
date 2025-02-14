<?php
include '../db/db_conn.php';

// Ambil query parameter
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 5; // Jumlah todo per halaman
$offset = ($page - 1) * $limit;

// Buat klausa pencarian
$whereClause = "";
if (!empty($search)) {
    $search = mysqli_real_escape_string($conn, $search);
    $whereClause = "WHERE judul_todo LIKE '%$search%' OR deskripsi_todo LIKE '%$search%'";
}

// Hitung total data setelah filter pencarian
$totalQuery = "SELECT COUNT(*) as total FROM data_todo $whereClause";
$totalResult = mysqli_query($conn, $totalQuery);
$totalData = mysqli_fetch_assoc($totalResult)['total'];

// Ambil data dengan limit dan offset
$query = "SELECT id_todo, judul_todo, deskripsi_todo, created_at, updated_at, status 
          FROM data_todo 
          $whereClause 
          ORDER BY id_todo DESC 
          LIMIT $limit OFFSET $offset";
          
$result = $conn->query($query);
$data_todo = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data_todo[] = $row;
    }
}

$conn->close();
?>