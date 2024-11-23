<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow: hidden;
        }

        .sidebar {
            width: 250px;
            background-color: #6a11cb;
            color: white;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            height: 100%;
            position: fixed;
            left: -250px; /* Hidden by default */
            transition: left 0.3s ease; /* Smooth transition */
        }

        .sidebar.active {
            left: 0; /* Show when active */
        }

        .sidebar h2 {
            text-align: center;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 15px 0;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            font-weight: 500;
        }

        .sidebar ul li a:hover {
            text-decoration: underline;
        }

        .main-content {
            flex-grow: 1;
            padding: 20px;
            margin-left: 0; /* No margin initially */
            overflow-y: auto;
            transition: margin-left 0.3s ease; /* Smooth transition */
        }

        .header {
            background-color: #2575fc;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 8px; /* Rounded corners */
            margin-bottom: 20px; /* Space below the header */
        }

        .tabs {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
            border-radius: 8px; /* Rounded corners */
            overflow: hidden; /* Prevent overflow for rounded corners */
            background-color: #f0f0f0; /* Background color */
        }

        .tab {
            flex: 1; /* Equal space for each tab */
            padding: 10px 0; /* Vertical padding */
            cursor: pointer;
            text-align: center;
            border: 1px solid #2575fc;
            background-color: #f0f0f0;
        }

        .tab.active {
            background-color: #2575fc;
            color: white;
        }

        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 5px 50px; /* Padding horizontal */
            margin: 20px 0;
        }

        .upload-btn {
            background-color: #6a11cb;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            display: block; /* Centering */
            margin-left: auto; /* Centering */
            margin-right: auto; /* Centering */
        }

        footer {
            text-align: center;
            padding: 10px 0;
            background-color: #6a11cb;
            color: white;
            position: relative;
            width: 100%;
        }

        .toggle-sidebar {
            background-color: #6a11cb;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 30px;
            cursor: pointer;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 10; /* Ensure it's above other elements */
        }

        .toggle-icon {
            font-size: 20px; /* Size of the icon */
        }
    </style>
</head>
<body>

    <button class="toggle-sidebar" onclick="toggleSidebar()">
        <span class="toggle-icon" id="sidebar-icon">></span>
    </button>

    <div class="sidebar" id="sidebar">
        <h2>Dashboard</h2>
        <ul>
            <li><a href="#">Beranda</a></li>
            <li><a href="#">Profil Saya</a></li>
            <li><a href="up_nonakademik.php">Unggah Prestasi</a></li>
            <li><a href="#" onclick="confirmLogout()">Keluar</a></li>
        </ul>
    </div>

    <div class="main-content" id="main-content">
        <div class="header">
            <h1>Selamat Datang, [Nama Pengguna]</h1>
        </div>

        <div class="tabs">
            <div class="tab active" onclick="showTab('akademik')">Prestasi Akademik</div>
            <div class="tab" onclick="showTab('non-akademik')">Prestasi Non-Akademik</div>
        </div>

        <div class="card" id="akademik">
            <h2>Riwayat Prestasi Akademik</h2>
            <ul>
                <li>IPK Semester 1: 3.5</li>
                <li>IPK Semester 2: 3.7</li>
                <li>Juara 1 Lomba Debat Antar Politeknik</li>
            </ul>
        </div>

        <div class="card" id="non-akademik" style="display: none;">
            <h2>Riwayat Prestasi Non-Akademik</h2>
            <ul>
                <li>Anggota Organisasi Mahasiswa</li>
                <li>Volunteering di Kegiatan Sosial</li>
                <li>Peserta Workshop Keterampilan</li>
            </ul>
        </div>

        <button class="upload-btn" id="upload-button" onclick="uploadPrestasi()" style="display: none;">
            Unggah Prestasi
        </button>
        
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
            const akademikTab = document.getElementById('akademik');
            const nonAkademikTab = document.getElementById('non-akademik');
            const tabs = document.querySelectorAll('.tab');
            const uploadButton = document.getElementById('upload-button');

            if (tabName === 'akademik') {
                akademikTab.style.display = 'block';
                nonAkademikTab.style.display = 'none';
                tabs[0].classList.add('active');
                tabs[1].classList.remove('active');
                uploadButton.style.display = 'none'; // Hide the button
            } else {
                akademikTab.style.display = 'none';
                nonAkademikTab.style.display = 'block';
                tabs[0].classList.remove('active');
                tabs[1].classList.add('active');
                uploadButton.style.display = 'block'; // Show the button
            }
        }

        function uploadPrestasi() {
            alert('Fungsi unggah prestasi akan ditambahkan di sini.');
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
