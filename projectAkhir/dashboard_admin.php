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
        }

        .sidebar {
            width: 250px;
            background-color: #6a11cb;
            color: white;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            height: 100%;
            position: fixed;
            left: -250px;
            transition: left 0.3s ease;
        }

        .sidebar.active {
            left: 0;
        }

        .sidebar h2 {
            text-align: center;
            padding-top: 16px;
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
            padding: 40px;
            margin-left: 0;
            overflow-y: auto;
            transition: margin-left 0.3s ease;
            box-sizing: border-box;
        }

        .header {
            background-color: #2575fc;
            color: white;
            padding: 5px;
            text-align: center;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
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
            display: block;
            margin-left: auto;
            margin-right: auto;
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
            z-index: 10;
        }

        .toggle-icon {
            font-size: 20px;
        }
    </style>
</head>
<body>

    <button class="toggle-sidebar" onclick="toggleSidebar()">
        <span class="toggle-icon" id="sidebar-icon">></span>
    </button>

    <div class="sidebar" id="sidebar">
        <h2>Dashboard Admin</h2>
        <ul>
            <li><a href="#" onclick="showSection('beranda')">Beranda</a></li>
            <li><a href="#" onclick="showSection('biodata')">Biodata Saya</a></li>
            <li><a href="#" onclick="showSection('unggah_prestasi')">Unggah Prestasi Akademik</a></li>
            <li><a href="#" onclick="showSection('unggah_prestasi_non_akademik')">Unggah Prestasi Non-Akademik</a></li>
            <li><a href="#" onclick="confirmLogout()">Keluar</a></li>
        </ul>
    </div>

    <div class="main-content" id="main-content">
        <div class="header">
            <h1>Selamat Datang, [Nama Admin]</h1>
        </div>

        <div class="card" id="beranda" style="display: block;">
            <h2>Beranda</h2>
            <p>Selamat datang di dashboard admin. Anda dapat memilih menu di atas untuk mengelola data dan prestasi akademik.</p>
        </div>
    

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const sidebarIcon = document.getElementById('sidebar-icon');

            sidebar.classList.toggle('active');
            if (sidebar.classList.contains('active')) {
                mainContent.style.marginLeft = '250px';
                sidebarIcon.textContent = '<';
            } else {
                mainContent.style.marginLeft = '0';
                sidebarIcon.textContent = '>';
            }
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
