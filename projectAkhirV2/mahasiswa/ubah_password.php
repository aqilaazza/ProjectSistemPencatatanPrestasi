<?php
// Mulai session untuk menangkap data login
session_start();

// Periksa apakah mahasiswa sudah login (misalnya dengan memeriksa session nim)
if (!isset($_SESSION['nim'])) {
    // Jika belum login, redirect ke halaman login atau dashboard
    header("Location: ../login/login_mahasiswa.php");
    exit;
}

// Ambil NIM dari session
$nim_login = $_SESSION['nim'];

// Sertakan koneksi ke database
include('../config/connection.php');

// Cek apakah form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nim = $_POST['nim']; // NIM yang diambil dari input form (tetap dari session)
    $password = $_POST['password'];

    // Hash password dengan bcrypt
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Buat objek koneksi
    $dbConnection = new connection();
    $pdo = $dbConnection->connect(); // Dapatkan objek PDO

    // Perbarui password pada tabel login_mahasiswa berdasarkan nim
    $query = "UPDATE login_mahasiswa SET password = :password WHERE nim = :nim";
    $stmt = $pdo->prepare($query);

    // Bind parameter
    $stmt->bindParam(':nim', $nim);
    $stmt->bindParam(':password', $hashedPassword);

    // Eksekusi query dan beri feedback kepada user
    if ($stmt->execute()) {
        echo "<script>alert('Password berhasil diperbarui!');</script>";
    } else {
        echo "<script>alert('Gagal memperbarui password.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        /* Styling untuk form */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow-y: scroll;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-image: url('../img/bg.png');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            height: 100%;
            padding: 20px;
            box-sizing: border-box;
        }
        .container {
            background-color: rgba(255, 255, 255, 1);
            border-radius: 25px;
            padding: 20px 40px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
            max-width: 500px;
            width: 100%;
            margin-top: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input {
            background-color: #eee;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 20px;
            box-sizing: border-box;
            font-size: 14px;
            margin-bottom: 15px;
        }
        input[readonly] {
            background-color: #ddd;
        }
        button {
            border-radius: 20px;
            border: none;
            background-image: linear-gradient(to right, #6a11cb, #2575fc);
            color: #fff;
            padding: 12px 45px;
            font-size: 12px;
            cursor: pointer;
            transition: transform 80ms ease-in;
            margin-top: 20px;
            align-self: center;
        }
        button:hover {
            background-image: linear-gradient(to right, #5a0e9d, #1e5bc0);
        }
        .login-link {
            margin-top: 20px;
            text-align: center;
        }
        .login-link a {
            color: #FF416C;
            text-decoration: none;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Ubah Password</h2>
        <form action="#" method="POST">
            <label for="nim">NIM</label>
            <!-- Input NIM otomatis dari session dan tidak bisa diubah -->
            <input type="text" name="nim" value="<?= $nim_login ?>" readonly />

            <label for="password">Password Baru</label>
            <input type="password" id="password" name="password" placeholder="Saran: maks 8 digit" required />

            <!-- Tombol untuk menunjukkan password -->
            <button type="button" onclick="togglePassword()">Show Password</button>

            <button type="submit">Ubah Password</button>
        </form>
        <div class="login-link">
            <p><a href="../dashboard/dashboardMahasiswa.php">Kembali</a></p>
        </div>
    </div>

    <script>
        // Fungsi untuk toggle visibility password
        function togglePassword() {
            var passwordField = document.getElementById('password');
            var passwordButton = document.querySelector('button[type="button"]');

            // Cek apakah tipe input password adalah "password"
            if (passwordField.type === "password") {
                passwordField.type = "text";  // Ganti tipe menjadi text untuk menunjukkan password
                passwordButton.textContent = "Hide Password"; // Ubah teks tombol
            } else {
                passwordField.type = "password"; // Ganti kembali tipe menjadi password
                passwordButton.textContent = "Show Password"; // Ubah teks tombol
            }
        }
    </script>
</body>
</html>