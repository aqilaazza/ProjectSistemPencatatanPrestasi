<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dosen</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="cssDosen.css">
        
</head>
<body>

    <button class="toggle-sidebar" onclick="toggleSidebar()">
        <span class="toggle-icon" id="sidebar-icon">></span>
    </button>

    <div class="sidebar" id="sidebar">
        <h2>Dashboard</h2>
        <ul>
            <li><a href="#">Beranda</a></li>
            <li><a href="../dosen/biodata_dosen.php">Profil Saya</a></li>
            <li><a href="../dosen/prestasi_akademik_dosen.php">Prestasi Akademik</a></li>
            <li><a href="#">Prestasi Non-Akademik</a></li>
            <li><a href="#" onclick="confirmLogout()">Keluar</a></li>
        </ul>
    </div>

    <div class="main-content" id="main-content">
        <div class="header">
            <h1>Selamat Datang, [Dosen]</h1>
        </div>

        <div class="tabs">
            <div class="tab active" onclick="showTab('daftar_mhs')">Daftar Mahasiswa yang dibimbing</div>
            <div class="tab" onclick="showTab('daftar_validasi')">Daftar Permintaan Validasi</div>
        </div>

        <div class="card" id="daftar_mhs" style="display: block;">
            <h2>Mahasiswa 1</h2>
            <ul>
                <li>NIM :</li>
                <li>Program Studi :</li>
                <li>Prestasi :</li>
            </ul>
        </div>

        <div class="card" id="daftar_mhs_2" style="display: none;">
            <h2>Mahasiswa 2</h2>
            <ul>
                <li>NIM :</li>
                <li>Program Studi :</li>
                <li>Prestasi :</li>
            </ul>
        </div>

        <div class="card" id="daftar_mhs_3" style="display: none;">
            <h2>Mahasiswa 3</h2>
            <ul>
                <li>NIM :</li>
                <li>Program Studi :</li>
                <li>Prestasi :</li>
            </ul>
        </div>

        <div class="card" id="daftar_validasi" style="display: none;">
            <h2>Validasi 1</h2>
            <ul>
                <li>NIM :</li>
                <li>Prodi :</li>
                <li>Dosen Pembimbing :</li>
                <li>Prestasi :</li>
                <li>Tanggal pengajuan :</li>
            </ul>
        </div>
        <div class="card" id="daftar_validasi" style="display: none;">
            <h2>Validasi 2</h2>
            <ul>
                <li>NIM :</li>
                <li>Prodi :</li>
                <li>Dosen Pembimbing :</li>
                <li>Prestasi :</li>
                <li>Tanggal pengajuan :</li>
            </ul>
        </div>
        <div class="card" id="daftar_validasi" style="display: none;">
            <h2>Validasi 3</h2>
            <ul>
                <li>NIM :</li>
                <li>Prodi :</li>
                <li>Dosen Pembimbing :</li>
                <li>Prestasi :</li>
                <li>Tanggal pengajuan :</li>
            </ul>
        </div>

    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const sidebarIcon = document.getElementById('sidebar-icon');

            sidebar.classList.toggle('active');
            if (sidebar.classList.contains('active')) {
                mainContent.style.marginLeft = '250px'; // Shift content to the right
                sidebarIcon.textContent = '<'; // Change icon to '<'
            } else {
                mainContent.style.marginLeft = '0'; // Reset margin
                sidebarIcon.textContent = '>'; // Change icon to '>'
            }
        }

        function showTab(tabName) {
            const daftarMhsTabs = document.querySelectorAll('[id^="daftar_mhs"]');
            const daftarValidasiTab = document.getElementById('daftar_validasi');
            const tabs = document.querySelectorAll('.tab');

            // Hide all cards first
            daftarMhsTabs.forEach(tab => {
                tab.style.display = 'none';
            });
            daftarValidasiTab.style.display = 'none'; // Hide validation tab by default

            // Show the appropriate tab and set active styling
            if (tabName === 'daftar_mhs') {
                daftarMhsTabs[0].style.display = 'block'; // Show the first mahasiswa card
                tabs[0].classList.add('active');
                tabs[1].classList.remove('active');
            } else if (tabName === 'daftar_validasi') {
                daftarValidasiTab.style.display = 'block'; // Show validation requests
                tabs[0].classList.remove('active');
                tabs[1].classList.add('active');
            }
        }

        function confirmLogout() {
        const confirmed = window.confirm("Apakah Anda yakin keluar?");
        if (confirmed) {
            // Arahkan ke login.php dengan query parameter untuk menampilkan pesan logout
            window.location.href = "../index.php?message=logout";
        } else {
            window.location.href = "../dashboard/dashboardDosen.php";
        }
    }
    </script>
</body>
</html>
