<!DOCTYPE html>
<html lang="en">
<?php
if (isset($_GET['message']) && $_GET['message'] == 'logout') {
    echo '<script>alert("Anda sudah berhasil keluar")</script>';
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-image: url('img/bg.png');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: rgba(255, 255, 255, 1);
            border-radius: 25px;
            padding: 20px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
            max-width: 400px;
            width: 100%;
            position: relative;
            padding-top: 40px;
        }

        .tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .tab {
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            margin: -5px;
            background-color: #6a11cb;
            color: white;
            transition: background-color 0.3s;
        }

        .tab.active {
            background-color: white;
            color: #6a11cb;
        }

        .form-container {
            display: none;
            padding: 20px;
        }

        .form-container.active {
            display: block;
        }

        input {
            background-color: #eee;
            border: none;
            padding: 15px;
            margin: 10px 0;
            width: 100%;
            border-radius: 20px;
            box-sizing: border-box;
            font-size: 14px;
        }

        button {
            border-radius: 20px;
            border: none;
            background-color: #6a11cb;
            color: #fff;
            padding: 12px 45px;
            font-size: 12px;
            cursor: pointer;
            width: 100%;
        }

        h2 {
            text-align: center;
        }

        .show-password {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: -10px; /* Sejajarkan dengan input sebelumnya */
            font-size: 14px;
        }

        .show-password input[type="checkbox"] {
            width: 16px;
            height: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="tabs">
            <div class="tab active" onclick="showTab('mahasiswa')">Mahasiswa</div>
            <div class="tab" onclick="showTab('admin')">Admin</div>
            <div class="tab" onclick="showTab('dosen')">Dosen</div>
        </div>
        <div class="forms">
            <form id="mahasiswa" class="form-container active" action="#">
                <h2>Login Mahasiswa</h2>
                <input type="text" placeholder="NIM" required />
                <input type="password" id="mahasiswa-password" placeholder="Password" required />
                <div class="show-password">
                    <input type="checkbox" id="mahasiswa-show-password" onclick="togglePasswordVisibility('mahasiswa-password', this)">
                    <label for="mahasiswa-show-password">Show Password</label>
                </div>
                <button type="submit">Login</button>
            </form>
            <form id="admin" class="form-container" action="#">
                <h2>Login Admin</h2>
                <input type="text" placeholder="ID ADMIN" required />
                <input type="password" id="admin-password" placeholder="Password" required />
                <div class="show-password">
                    <input type="checkbox" id="admin-show-password" onclick="togglePasswordVisibility('admin-password', this)">
                    <label for="admin-show-password">Show Password</label>
                </div>
                <button type="submit">Login</button>
            </form>
            <form id="dosen" class="form-container" action="#">
                <h2>Login Dosen</h2>
                <input type="text" placeholder="NIDN" required />
                <input type="password" id="dosen-password" placeholder="Password" required />
                <div class="show-password">
                    <input type="checkbox" id="dosen-show-password" onclick="togglePasswordVisibility('dosen-password', this)">
                    <label for="dosen-show-password">Show Password</label>
                </div>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>

    <script>
        function showTab(tabName) {
            const forms = document.querySelectorAll('.form-container');
            forms.forEach(form => {
                form.classList.remove('active');
            });

            const tabs = document.querySelectorAll('.tab');
            tabs.forEach(tab => {
                tab.classList.remove('active');
            });

            document.getElementById(tabName).classList.add('active');
            const activeTab = Array.from(tabs).find(tab => tab.textContent.toLowerCase() === tabName.toLowerCase());
            activeTab.classList.add('active');
        }

        function togglePasswordVisibility(passwordId, checkbox) {
            const passwordField = document.getElementById(passwordId);
            passwordField.type = checkbox.checked ? 'text' : 'password';
        }
    </script>
</body>
</html>
