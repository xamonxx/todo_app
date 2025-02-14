<?php
$host = "127.0.0.1"; // Alamat server database
$username = "root";  // Username untuk login ke database
$password = "";  // Password untuk login ke database
$dbname = "db_xamon";    // Nama database    // Port baru yang telah kamu atur di MariaDB/MySQL


// Membuat koneksi dengan port yang ditentukan
$conn = new mysqli($host, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
