<?php
session_start();

// Pastikan mahasiswa sudah login
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'mahasiswa') {
    die("Akses ditolak. Anda harus login terlebih dahulu.");
}

// Ambil data mahasiswa dari session
$nim = $_SESSION['nim'];
$nama = $_SESSION['nama'];
// Lakukan query untuk mengambil data mahasiswa berdasarkan NIM jika perlu
// Misalnya mengambil data dari database berdasarkan NIM

// Koneksi database dan ambil data mahasiswa berdasarkan NIM
require_once '../config/connection.php';
$conn = (new connection())->connect();
$query = "SELECT * FROM mahasiswa WHERE nim = :nim";
$stmt = $conn->prepare($query);
$stmt->bindParam(':nim', $nim);
$stmt->execute();
$mahasiswa = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$mahasiswa) {
    die("Data mahasiswa tidak ditemukan.");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="cssMahasiswa.css">
</head>
<body>

<div class="sidebar">
    <h2>Dashboard Mahasiswa</h2>
    <ul>
        <li><a href="#">Beranda</a></li>
        <li><a href="../mahasiswa/profil_mahasiswa.php">Profil Saya</a></li>
        <li><a href="../mahasiswa/prestasi_akademik.php">Prestasi Akademik</a></li>
        <li><a href="../mahasiswa/up_nonakademik.php">Prestasi Non-Akademik</a></li>
        <li><a href="#" onclick="confirmLogout()">Keluar</a></li>
    </ul>
</div>

<div class="main-content">
    <div class="header">
        <h1>Selamat Datang, <?php echo htmlspecialchars($mahasiswa['nama_lengkap']); ?>!</h1>
    </div>
</div>

<script>
    function confirmLogout() {
        const confirmed = window.confirm("Apakah Anda yakin keluar?");
        if (confirmed) {
            window.location.href = "../index.php?message=logout";
        } else {
            window.location.href = "../dashboard/dashboardMahasiswa.php";
        }
    }
</script>

</body>
</html>
