<?php
session_start();
include('../config/connection.php');

try {
    $dbConnection = new connection();
    $pdo = $dbConnection->connect();

    // Cek apakah mahasiswa sudah login
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'mahasiswa') {
        throw new Exception("Anda tidak memiliki akses ke halaman ini.");
    }

    $nim = $_SESSION['nim'];

    // Query join tabel mahasiswa dan prestasi_akademik
    $query = "
        SELECT m.nim, m.nama_lengkap, pa.semester, pa.ip 
        FROM mahasiswa m 
        JOIN prestasi_akademik pa 
        ON m.nim = pa.nim 
        WHERE m.nim = :nim
    ";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':nim', $nim, PDO::PARAM_STR);
    $stmt->execute();
    $dataAkademik = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$dataAkademik) {
        throw new Exception("Data tidak ditemukan untuk NIM: " . $nim);
    }
} catch (Exception $e) {
    error_log($e->getMessage());
    echo "Terjadi kesalahan. Silakan coba lagi nanti.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prestasi Akademik</title>
    <!-- Link to Google Fonts (Poppins) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-image: url('../img/bg.png');
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            padding: 40px;
            background-size: cover;
            background-position: center;
            background-color: rgba(255, 255, 255, 0.9);
        }

        h1 {
            text-align: center;
            color: #800088;
            margin-bottom: 30px;
            font-size: 3rem;
            font-weight: 600;
        }

        .data-container {
            margin: 30px 0;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.85);
        }

        .data-item {
            margin: 20px 0;
            font-size: 20px;
            font-weight: 400;
            color: #333;
        }

        .data-value {
            font-weight: bold;
            color: black;
            font-size: 18px;
        }

        .login-link {
            margin-top: 25px;
            text-align: center;
        }

        .login-link a {
            color: #FF416C;
            text-decoration: none;
            font-weight: 600;
            font-size: 18px;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Prestasi Akademik</h1>
        <div class="data-container">
            <div class="data-item">
                <span>Nama Lengkap : </span>
                <span class="data-value"><?php echo htmlspecialchars($dataAkademik['nama_lengkap']); ?></span>
            </div>
            <div class="data-item">
                <span>NIM : </span>
                <span class="data-value"><?php echo htmlspecialchars($dataAkademik['nim']); ?></span>
            </div>
            <div class="data-item">
                <span>Semester : </span>
                <span class="data-value"><?php echo htmlspecialchars($dataAkademik['semester']); ?></span>
            </div>
            <div class="data-item">
                <span>IP : </span>
                <span class="data-value"><?php echo htmlspecialchars($dataAkademik['ip']); ?></span>
            </div>
        </div>
        <div class="login-link">
            <p><a href="../dashboard/dashboardMahasiswa.php">Kembali</a></p>
        </div>
    </div>
</body>
</html>
