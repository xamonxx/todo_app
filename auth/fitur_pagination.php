<?php
include '../db/db_conn.php'; // Koneksi database

$limit = 4; // Jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : "";

// Query pencarian
$search_query = "";
if (!empty($search)) {
    $search_query = " WHERE judul_todo LIKE '%$search%' OR deskripsi_todo LIKE '%$search%'";
}

// Hitung total data sesuai pencarian
$result = mysqli_query($conn, "SELECT COUNT(*) as total FROM data_todo $search_query");
$row = mysqli_fetch_assoc($result);
$total_rows = $row['total'];
$total_pages = ceil($total_rows / $limit);

// Ambil data sesuai halaman dan pencarian
$query = "SELECT * FROM data_todo $search_query ORDER BY pinned DESC, created_at DESC LIMIT $start, $limit";
$data_todo = mysqli_query($conn, $query);
?>
