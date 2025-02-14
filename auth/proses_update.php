<?php
include '../db/db_conn.php'; // Pastikan file ini ada dan berisi koneksi ke database

// Menentukan header sebagai JSON
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_todo = $_POST['id_todo'];
    $judul = trim($_POST['judul_todo']);
    $deskripsi = trim($_POST['deskripsi_todo']);

    // Pastikan data tidak kosong
    if (!empty($id_todo) && !empty($judul) && !empty($deskripsi)) {
        // Query update
        $query = "UPDATE data_todo SET judul_todo = ?, deskripsi_todo = ?, updated_at = NOW() WHERE id_todo = ?";
        $stmt = $conn->prepare($query);
        
        // Pastikan query berhasil disiapkan
        if ($stmt) {
            $stmt->bind_param("ssi", $judul, $deskripsi, $id_todo);

            // Eksekusi query
            if ($stmt->execute()) {
                // Kirim respons sukses dalam format JSON
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Data berhasil diperbarui'
                ]);
            } else {
                // Jika gagal eksekusi query
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Gagal memperbarui data'
                ]);
            }

            // Tutup statement
            $stmt->close();
        } else {
            // Jika query tidak berhasil disiapkan
            echo json_encode([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat mempersiapkan query'
            ]);
        }
    } else {
        // Jika ada data yang kosong
        echo json_encode([
            'status' => 'error',
            'message' => 'Semua kolom harus diisi'
        ]);
    }
} else {
    // Jika request bukan POST
    echo json_encode([
        'status' => 'error',
        'message' => 'Request tidak valid'
    ]);
}

exit;