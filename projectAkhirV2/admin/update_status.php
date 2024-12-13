<?php
// Mengimpor file connection.php untuk menghubungkan ke database
require_once '../config/connection.php';

try {
    // Membuat instance koneksi
    $db = new connection();
    $conn = $db->connect();

    // Memeriksa apakah data 'nama_kompetisi' dan 'status_validasi' dikirimkan melalui POST
    if (isset($_POST['nama_kompetisi']) && isset($_POST['status_validasi'])) {
        // Menangkap data yang dikirimkan
        $nama_kompetisi = $_POST['nama_kompetisi'];
        $status_validasi = $_POST['status_validasi'];

        // Jika status_validasi adalah "diterima", maka update kolom status_validasi di database
        if ($status_validasi === 'diterima') {
            $query = "UPDATE prestasi_nonakademik 
                      SET status_validasi = :status_validasi 
                      WHERE nama_kompetisi = :nama_kompetisi";
            $stmt = $conn->prepare($query);

            // Mengikat parameter
            $stmt->bindValue(':status_validasi', $status_validasi, PDO::PARAM_STR);
            $stmt->bindValue(':nama_kompetisi', $nama_kompetisi, PDO::PARAM_STR);

            // Menjalankan query
            $stmt->execute();
        } else {
            $query = "UPDATE prestasi_nonakademik 
            SET status_validasi = :status_validasi 
            WHERE nama_kompetisi = :nama_kompetisi";
            $stmt = $conn->prepare($query);

            // Mengikat parameter
            $stmt->bindValue(':status_validasi', $status_validasi, PDO::PARAM_STR);
            $stmt->bindValue(':nama_kompetisi', $nama_kompetisi, PDO::PARAM_STR);

            // Menjalankan query
            $stmt->execute();
        }
    } else {
        // Jika data tidak lengkap
        echo json_encode(['success' => false, 'message' => 'Data tidak lengkap']);
    }
} catch (Exception $e) {
    // Menangani error dan mengirimkan respon error
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>