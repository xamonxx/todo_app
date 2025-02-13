<?php
include '../db/db_conn.php'; // Memanggil koneksi database

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Mengambil data dari form
    $judul_todo = $_POST['judul_todo'];
    $deskripsi_todo = $_POST['deskripsi_todo'];

    // Menggunakan prepared statement untuk menghindari SQL Injection
    $stmt = $conn->prepare("INSERT INTO data_todo (judul_todo, deskripsi_todo) VALUES (?, ?)");
    $stmt->bind_param("ss", $judul_todo, $deskripsi_todo);

    if ($stmt->execute()) {
        $status = "success";
        $message = "Data berhasil ditambahkan!";
    } else {
        $status = "error";
        $message = "Gagal menambahkan data: " . $stmt->error;
    }

    // Redirect kembali ke index.php dengan notifikasi
    $stmt->close();
    $conn->close();
    header("Location: ../app/index.php?status=$status&message=$message");
    exit;
}
?>