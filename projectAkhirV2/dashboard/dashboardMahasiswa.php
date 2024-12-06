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
    <link rel="stylesheet" href="cssMahasiswa.css"> <!-- Link to the external CSS file -->
</head>
<body>

<button class="toggle-sidebar" onclick="toggleSidebar()">
    <span class="toggle-icon" id="sidebar-icon">></span>
</button>

<div class="sidebar">
        <h2>Dashboard Mahasiswa</h2>
        <ul>
            <li><a href="#">Beranda</a></li>
            <li><a href="#">Profil Saya</a></li>
            <li><a href="#">Prestasi Akademik</a></li>
            <li><a href="#">Prestasi Non-Akademik</a></li>
            <li><a href="#" onclick="confirmLogout()">Keluar</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Selamat Datang, [Mahasiswa]</h1>
        </div>

        <div class="tabs">
            <div class="tab active" onclick="showTab('akademik')">Prestasi Akademik</div>
            <div class="tab" onclick="showTab('non-akademik')">Prestasi Non-Akademik</div>
        </div>

        <div class="card" id="akademik">
            <h2>Riwayat Prestasi Akademik</h2>
            <ul>
                <li>
                    <strong>IPK Semester 1:</strong> 3.5
                    <p>Periode: Ganjil 2023/2024</p>
                </li>
                <li>
                    <strong>IPK Semester 2:</strong> 3.7
                    <p>Periode: Genap 2023/2024</p>
                </li>
                <li>
                    <strong>Juara 1 Lomba Debat Antar Politeknik</strong>
                    <p>Tanggal: 15 Maret 2024</p>
                </li>
            </ul>
            <div class="button-container">
                <button class="upload-btn" onclick="uploadPrestasi()">Input Prestasi</button>
                <button class="upload-btn" onclick="editPrestasi()">Ubah Prestasi</button>
            </div>
        </div>

        <div class="card" id="non-akademik" style="display: none;">
            <h2>Riwayat Prestasi Non-Akademik</h2>
            <ul>
                <li>
                    <strong>Anggota Organisasi Mahasiswa</strong>
                    <p>BEM Politeknik - Periode 2023/2024</p>
                </li>
                <li>
                    <strong>Volunteering di Kegiatan Sosial</strong>
                    <p>Program Bakti Sosial - Oktober 2023</p>
                </li>
                <li>
                    <strong>Peserta Workshop Keterampilan</strong>
                    <p>Workshop UI/UX Design - Desember 2023</p>
                </li>
            </ul>
            <div class="button-container">
                <button class="upload-btn" onclick="uploadPrestasi()">Input Prestasi</button>
                <button class="upload-btn" onclick="editPrestasi()">Ubah Prestasi</button>
            </div>
        </div>
    </div>
    <script>
    function toggleSidebar() {
        const sidebar = document.querySelector('.sidebar');
        const mainContent = document.querySelector('.main-content');
        const sidebarIcon = document.getElementById('sidebar-icon');

        // Toggle visibility of sidebar
        if (sidebar.style.display === 'none' || !sidebar.style.display) {
            sidebar.style.display = 'block'; // Show sidebar
            mainContent.style.marginLeft = '250px'; // Adjust main content margin
            sidebarIcon.textContent = '<'; // Change icon to '<'
        } else {
            sidebar.style.display = 'none'; // Hide sidebar
            mainContent.style.marginLeft = '0'; // Reset main content margin
            sidebarIcon.textContent = '>'; // Change icon to '>'
        }
    }

    function showTab(tabName) {
        const tabs = document.querySelectorAll('.tab');
        const cards = document.querySelectorAll('.card');

        // Reset all tabs and cards
        tabs.forEach(tab => tab.classList.remove('active'));
        cards.forEach(card => (card.style.display = 'none'));

        // Show the selected tab and its content
        document.querySelector(`#${tabName}`).style.display = 'block';
        document.querySelector(`.tab[onclick="showTab('${tabName}')"]`).classList.add('active');
    }

    function confirmLogout() {
        const confirmed = window.confirm("Apakah Anda yakin keluar?");
        if (confirmed) {
            window.location.href = "login.php?message=logout";
        }
    }
    </script>
</body>
</html>
