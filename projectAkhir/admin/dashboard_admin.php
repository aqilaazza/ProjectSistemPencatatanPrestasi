<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            display: flex;
            flex-direction: column;
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

        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px 0;
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

        /* Sidebar menu hover effect */
        .sidebar ul li:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group input, .form-group select, .form-group button {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-group button {
            background-color: #2A6BF8;
            color: white;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #1a4db4;
        }

    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Dashboard Admin</h2>
        <ul>
            <li><a href="beranda.php">Beranda</a></li>
            <li><a href="biodata_admin.php">Biodata Admin</a></li>
            <li><a href="biodata_dosen.php">Biodata Dosen</a></li>
            <li><a href="biodata_mahasiswa.php">Biodata Mahasiswa</a></li>
            <li><a href="prestasi_akademik.php">Unggah Prestasi Akademik</a></li>
            <li><a href="validasi_prestasi.php">Validasi Prestasi Non-Akademik</a></li>
            <li><a href="#" onclick="confirmLogout()">Keluar</a></li>
        </ul>
    </div>

    <div class="main-content" id="main-content">
        <div class="header">
            <h1>Selamat Datang, Admin</h1>
        </div>

        <!-- Beranda -->
        <div class="card" id="beranda" style="display: block;">
            <h2>Beranda</h2>
            <p>Ini adalah laman beranda. Di sini Anda dapat melihat informasi umum mengenai dashboard dan akses menu lainnya untuk mengelola data dan prestasi.</p>
        </div>

        <!-- Biodata Admin -->
        <div class="card" id="biodata_admin" style="display: none;">
            <h2>Biodata Admin</h2>
            <div class="form-group">
                <label for="search-nip">Search by NIP</label>
                <input type="text" id="search-nip" placeholder="Masukkan NIP" />
            </div>
            <div class="form-group">
                <button onclick="openForm('add-admin')">Tambah Admin</button>
                <button onclick="openForm('edit-admin')">Ubah Data Admin</button>
            </div>
            <p>Di laman ini, Anda dapat mengelola data pribadi admin, seperti nama, alamat, dan informasi lainnya yang relevan dengan akun admin.</p>
        </div>

        <!-- Biodata Dosen -->
        <div class="card" id="biodata_dosen" style="display: none;">
            <h2>Biodata Dosen</h2>
            <div class="form-group">
                <label for="search-nidn">Search by NIDN</label>
                <input type="text" id="search-nidn" placeholder="Masukkan NIDN" />
            </div>
            <div class="form-group">
                <button onclick="openForm('add-dosen')">Tambah Dosen</button>
                <button onclick="openForm('edit-dosen')">Ubah Data Dosen</button>
            </div>
            <p>Di halaman ini, Anda dapat melihat dan mengelola biodata dosen, seperti nama, mata kuliah yang diampu, serta informasi akademik dosen lainnya.</p>
        </div>

        <!-- Biodata Mahasiswa -->
        <div class="card" id="biodata_mahasiswa" style="display: none;">
            <h2>Biodata Mahasiswa</h2>
            <div class="form-group">
                <label for="search-nim">Search by NIM</label>
                <input type="text" id="search-nim" placeholder="Masukkan NIM" />
            </div>
            <div class="form-group">
                <button onclick="openForm('add-mahasiswa')">Tambah Mahasiswa</button>
                <button onclick="openForm('edit-mahasiswa')">Ubah Data Mahasiswa</button>
            </div>
            <p>Halaman ini berfungsi untuk mengelola biodata mahasiswa, mencakup informasi pribadi, jurusan, dan data lainnya terkait mahasiswa di sistem.</p>
        </div>

        <!-- Form Tambah/Edit Admin/Dosen/Mahasiswa -->
        <div class="card" id="form-container" style="display: none;">
            <h2 id="form-title">Form Data</h2>
            <form id="form-data">
                <div class="form-group">
                    <label for="input-id">ID</label>
                    <input type="text" id="input-id" placeholder="Masukkan ID" />
                </div>
                <div class="form-group">
                    <label for="input-name">Nama</label>
                    <input type="text" id="input-name" placeholder="Masukkan Nama" />
                </div>
                <div class="form-group">
                    <label for="input-email">Email</label>
                    <input type="email" id="input-email" placeholder="Masukkan Email" />
                </div>
                <div class="form-group">
                    <label for="input-phone">Nomor Telepon</label>
                    <input type="text" id="input-phone" placeholder="Masukkan Nomor Telepon" />
                </div>
                <div class="form-group">
                    <label for="input-address">Alamat</label>
                    <input type="text" id="input-address" placeholder="Masukkan Alamat" />
                </div>
                <div class="form-group">
                    <button type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <footer>
        V 1.1.0
    </footer>

    <script>
        function showSection(section) {
            // Hide all sections
            const sections = document.querySelectorAll('.card');
            sections.forEach(section => {
                section.style.display = 'none';
            });

            // Show the selected section
            const activeSection = document.getElementById(section);
            if (activeSection) {
                activeSection.style.display = 'block';
            }
        }

        function confirmLogout() {
            const confirmed = window.confirm("Apakah Anda yakin keluar?");
            if (confirmed) {
                window.location.href = "login.php?message=logout";
            }
        }

        function openForm(formType) {
            // Show form container
            document.getElementById('form-container').style.display = 'block';

            // Set form title and fields based on form type
            const titleMap = {
                'add-admin': 'Tambah Admin',
                'edit-admin': 'Ubah Data Admin',
                'add-dosen': 'Tambah Dosen',
                'edit-dosen': 'Ubah Data Dosen',
                'add-mahasiswa': 'Tambah Mahasiswa',
                'edit-mahasiswa': 'Ubah Data Mahasiswa'
            };
            
            document.getElementById('form-title').innerText = titleMap[formType] || 'Form Data';
        }
    </script>

</body>
</html>