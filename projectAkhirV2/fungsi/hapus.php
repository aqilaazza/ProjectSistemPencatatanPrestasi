<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id']) && isset($_POST['type'])) {
        $id = $_POST['id'];
        $type = $_POST['type'];

        if ($type == 'mahasiswa') {
            try {
                include('../config/connection.php');
                $dbConnection = new connection();
                $pdo = $dbConnection->connect();

                // Query untuk menghapus data mahasiswa berdasarkan ID
                $stmt = $pdo->prepare("DELETE FROM mahasiswa WHERE nim = :id");
                $stmt->bindParam(':id', $id, PDO::PARAM_STR);
                $stmt->execute();

                // Cek apakah ada baris yang dihapus
                if ($stmt->rowCount() > 0) {
                    header("Location: ../admin/biodata_mahasiswa.php?message=deleted");
                } else {
                    header("Location: ../admin/biodata_mahasiswa.php?message=error");
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } elseif ($type == 'dosen') { // Jika tipe adalah 'dosen'
            try {
                include('../config/connection.php');
                $dbConnection = new connection();
                $pdo = $dbConnection->connect();

                // Query untuk menghapus data dosen berdasarkan ID
                $stmt = $pdo->prepare("DELETE FROM dosen WHERE nidn = :id");
                $stmt->bindParam(':id', $id, PDO::PARAM_STR);
                $stmt->execute();

                // Cek apakah ada baris yang dihapus
                if ($stmt->rowCount() > 0) {
                    header("Location: ../admin/biodata_dosen.php?message=deleted");
                } else {
                    header("Location: ../admin/biodata_dosen.php?message=error");
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } elseif ($type == 'admin') { // Jika tipe adalah 'admin'
            try {
                include('../config/connection.php');
                $dbConnection = new connection();
                $pdo = $dbConnection->connect();

                // Query untuk menghapus data admin berdasarkan ID
                $stmt = $pdo->prepare("DELETE FROM admin WHERE nip = :id");
                $stmt->bindParam(':id', $id, PDO::PARAM_STR);
                $stmt->execute();

                // Cek apakah ada baris yang dihapus
                if ($stmt->rowCount() > 0) {
                    header("Location: ../admin/biodata_admin.php?message=deleted");
                } else {
                    header("Location: ../admin/biodata_admin.php?message=error");
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }
}
?>


