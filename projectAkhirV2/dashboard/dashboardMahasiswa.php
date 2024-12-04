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
    <title>Dashboard Mahasiswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="cssDashboard.css"> <!-- Link to the external CSS file -->
</head>
<body>

    <div class="sidebar">
        <h2>Dashboard Mahasiswa</h2>
        <ul>
            <li><a href="">Beranda</a></li>
            <li><a href="">Profil Saya</a></li>
            <li><a href="">Validasi Prestasi</a></li>
            <li><a href="#" onclick="confirmLogout()">Keluar</a></li>
        </ul>
    </div>

    <div class="main-content" id="main-content">
        <div class="header">
            <h1>Selamat Datang, [Nama Mahasiswa]</h1>
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
