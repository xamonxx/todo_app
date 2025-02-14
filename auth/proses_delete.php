<?php
// Sertakan file koneksi
include '../db/db_conn.php';

// Periksa apakah request menggunakan metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil ID dari form
    $id_todo = $_POST['id_todo'];

    // Query untuk menghapus data
    $sql = "DELETE FROM data_todo WHERE id_todo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_todo);

    // Eksekusi query
    if ($stmt->execute()) {
        // Redirect kembali ke halaman index dengan pesan sukses
        header("Location: ../app/index.php?status=success&message=" . urlencode("Data berhasil dihapus!"));
    } else {
        // Redirect kembali ke halaman index dengan pesan error
        header("Location: ../app/index.php?status=error&message=" . urlencode("Gagal menghapus data!"));
    }

    $stmt->close();
}

$conn->close();
?>