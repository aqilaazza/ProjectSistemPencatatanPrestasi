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
            height: 100vh;
            overflow: hidden;
            background-color: #f5f6fa;
        }

        .sidebar {
            width: 250px;
            background-color: #5828E2;
            color: white;
            font-size:36;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            height: 100%;
            position: fixed;
            left: 0;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 5px 0;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .sidebar ul li:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            display: block;
        }

        .main-content {
            flex-grow: 1;
            margin-left: 250px;
            padding: 30px;
            overflow-y: auto;
            background-color: #f5f6fa;
        }

        .header {
            background-color: #2A6BF8;
            color: white;
            text-align:center;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(37, 117, 252, 0.1);
        }

        .header h1 {
            margin: 0;
            font-size: 1.8rem;
        }

        .tabs {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
            border-radius: 15px; /* Rounded corners */
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
        .tab.active {
            background-color: #2A6BF8;
            color: white;
            box-shadow: 0 2px 10px rgba(37, 117, 252, 0.2);
        }

        .card {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
            padding: 25px;
            margin-bottom: 30px;
            
        }

        .card h2 {
            color: #000000;
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 1.5rem;
        }

        .card ul {
            padding-left: 20px;
        }

        .card ul li {
            margin-bottom: 15px;
            color: #000000;
            line-height: 1.6;
        }

        .button-container {
            display: flex;
            gap: 15px;
            margin-top: 25px;
        }

        .upload-btn {
            background: linear-gradient(135deg, #2575fc, #6a11cb);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
            flex: 1;
            max-width: 200px;
        }

        .upload-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(37, 117, 252, 0.2);
        }

        footer {
            background-color: #5828E2;
            color: white;
            text-align: center;
            padding: 0px;
            position: fixed;
            bottom: 0;
            margin-left: 127px;
            padding-bottom:50px;
            
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Dashboard Mahasiswa</h2>
        <ul>
            <li><a href="#">Beranda</a></li>
            <li><a href="profil.php">Biodata Mahasiswa</a></li>
            <li><a href="prestasi_akademik.php">Prestasi Akademik</a></li>
            <li><a href="prestasi_nonakademik.php">Prestasi Non-Akademik</a></li>
            <li><a href="#" onclick="confirmLogout()">Keluar</a></li>
        </ul>
    </div>

    <div class="main-content">
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

    <footer>
        V 1.1.0
    </footer>

    <script>
        function showTab(tabName) {
            const akademikTab = document.getElementById('akademik');
            const nonAkademikTab = document.getElementById('non-akademik');
            const tabs = document.querySelectorAll('.tab');

            if (tabName === 'akademik') {
                akademikTab.style.display = 'block';
                nonAkademikTab.style.display = 'none';
                tabs[0].classList.add('active');
                tabs[1].classList.remove('active');
            } else {
                akademikTab.style.display = 'none';
                nonAkademikTab.style.display = 'block';
                tabs[0].classList.remove('active');
                tabs[1].classList.add('active');
            }
        }

        function uploadPrestasi() {
            alert('Fungsi untuk input prestasi akan ditambahkan di sini.');
        }

        function editPrestasi() {
            alert('Fungsi untuk mengedit prestasi akan ditambahkan di sini.');
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
