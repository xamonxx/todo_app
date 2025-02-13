<?php
// Pastikan metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['check_id'])) {
    $checkedId = (int)$_POST['check_id']; // Ambil ID tugas yang di-check

    // Redirect kembali ke halaman utama dengan parameter ID
    header("Location: index.php?checked_id=$checkedId");
    exit;
} else {
    // Jika akses langsung ke file ini, redirect ke halaman utama
    header("Location: ../index.php");
    exit;
}
?>
