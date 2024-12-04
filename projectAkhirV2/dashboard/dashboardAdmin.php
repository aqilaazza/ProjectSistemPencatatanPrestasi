<?php
    if (isset($_GET['message']) && $_GET['message'] == 'logout') {
        echo '<script>alert("Anda sudah berhasil keluar")</script>';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="cssDashboard.css"> <!-- Link to the external CSS file -->
</head>

<body>
    <div class="sidebar">
        <h2>Dashboard Admin</h2>
        <ul>
            <li><a href="#">Beranda</a></li>
            <li><a href="../admin/biodata_admin.php">Biodata Admin</a></li>
            <li><a href="../admin/biodata_dosen.php/">Biodata Dosen</a></li>
            <li><a href="../admin/biodata_mahasiswa.php">Biodata Mahasiswa</a></li>
            <li><a href="../admin/prestasi_akademik.php">Unggah Prestasi Akademik</a></li>
            <li><a href="../admin/validasi_prestasi.php">Validasi Prestasi Non-Akademik</a></li>
            <li><a href="../login.php" onclick="confirmLogout()">Keluar</a></li>
        </ul>
    </div>

    <div class="main-content" id="main-content">
        <div class="header">
            <h1>Selamat Datang, [Nama Admin]</h1>
        </div>

    <footer>
        V 1.1.0
    </footer>

    <script>
        function confirmLogout() {
            const confirmed = window.confirm("Apakah Anda yakin keluar?");
            if (confirmed) {
                window.location.href = "login.php?message=logout";
            }
        }
    </script>

</body>
</html>
