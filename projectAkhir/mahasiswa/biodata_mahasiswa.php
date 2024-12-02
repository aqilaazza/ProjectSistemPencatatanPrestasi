<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
            background-color: #6a11cb;
            color: white;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            height: 100%;
            position: fixed;
            left: 0;
            transition: all 0.3s ease;
        }

        .sidebar h2 {
            text-align: center;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 10px 0;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            font-weight: 500;
        }

        .sidebar ul li a:hover {
            text-decoration: underline;
        }
        .sidebar.active {
            width: 250px; /* Tetap pertahankan lebar */
            visibility: hidden; /* Sembunyikan */
            opacity: 0; /* Buat transparan */
            transition: opacity 0.3s ease, visibility 0.3s ease; /* Smooth transition */
        }


        .main-content {
            margin-left: 250px;
            padding: 20px;
            flex-grow: 1;
            overflow-y: auto;
            transition: margin-left 0.3s ease;
        }

        .header {
            background-color: #2575fc;
            color: white;
            text-align: center;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .tabs {
            display: flex;
            margin-bottom: 20px;
            background-color: #f0f0f0;
            border-radius: 8px;
            overflow: hidden;
        }

        .tab {
            flex: 1;
            padding: 10px;
            text-align: center;
            cursor: pointer;
            border: 1px solid #2575fc;
            background-color: #f0f0f0;
            transition: background-color 0.3s ease;
        }

        .tab.active {
            background-color: #2575fc;
            color: white;
        }

        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .toggle-sidebar {
            background-color: #6a11cb;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 8px;
            cursor: pointer;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
        }
    </style>
</head>
<body>

    <button class="toggle-sidebar" onclick="toggleSidebar()">Toggle Sidebar</button>

    <div class="sidebar" id="sidebar">
        <h2>Dashboard</h2>
        <ul>
            <li><a href="#">Beranda</a></li>
            <li><a href="#">Profil</a></li>
            <li><a href="#">Validasi</a></li>
            <li><a href="#">Logout</a></li>
        </ul>
    </div>

    <div class="main-content" id="main-content">
        <div class="header">
            <h1>Selamat Datang, Pengguna</h1>
        </div>

        <div class="tabs">
            <div class="tab active" onclick="switchTab('content1')">Tab 1</div>
            <div class="tab" onclick="switchTab('content2')">Tab 2</div>
        </div>

        <div class="card" id="content1">
            <h2>Konten Tab 1</h2>
            <p>Ini adalah konten untuk Tab 1.</p>
        </div>

        <div class="card" id="content2" style="display: none;">
            <h2>Konten Tab 2</h2>
            <p>Ini adalah konten untuk Tab 2.</p>
        </div>
    </div>

    <script>
       function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const sidebarIcon = document.getElementById('sidebar-icon');

    // Toggle visibility and icon state
    if (sidebar.classList.contains('active')) {
        sidebar.classList.remove('active');
        sidebar.style.opacity = '1'; // Restore visibility
        sidebar.style.visibility = 'visible';
        sidebarIcon.textContent = '<'; // Icon for closing
    } else {
        sidebar.classList.add('active');
        sidebar.style.opacity = '0'; // Hide visibility
        sidebar.style.visibility = 'hidden';
        sidebarIcon.textContent = '>'; // Icon for opening
    }
}

        function switchTab(tabId) {
            const tabs = document.querySelectorAll('.tab');
            const contents = document.querySelectorAll('.card');

            tabs.forEach(tab => tab.classList.remove('active'));
            contents.forEach(content => content.style.display = 'none');

            document.querySelector(`.tab[onclick="switchTab('${tabId}')"]`).classList.add('active');
            document.getElementById(tabId).style.display = 'block';
        }
    </script>
</body>
</html>
