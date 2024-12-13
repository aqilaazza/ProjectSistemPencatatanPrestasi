<?php
include('../config/connection.php');
include('../models/user.php');
include('../models/admin.php');

// Pastikan koneksi database ($pdo) tersedia
$conn = new Connection();
$pdo = $conn->connect();

$admin = new Admin($pdo); // Buat objek Admin untuk mengakses metode models
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'nip' => $_POST['nip'],
        'nama' => $_POST['nama'],
        'email' => $_POST['email'],
        'no_telp' => $_POST['no_telp'],
        'alamat' => $_POST['alamat']
    ];

    if ($admin->nipExists($data['nip'])) {
        echo "<p style='color: red; text-align: center;'>NIP sudah terdaftar. Silakan gunakan NIP lain.</p>";
    } else {
        if ($admin->create($data)) {
            header("Location: biodata_admin.php?message=added"); // Pengalihan dengan pesan notifikasi
            exit();
        } else {
            echo "<p style='color: red; text-align: center;'>Gagal menyimpan data. Silakan coba lagi.</p>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        /* Menghilangkan margin dan padding default untuk body dan html */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-image: url('../img/bg.png');
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
            padding: 40px 40px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
            max-width: 400px;
            width: 100%;
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        h2 {
            margin-bottom: 20px;
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

        button {
            border-radius: 20px;
            border: none;
            background-image: linear-gradient(to right, #6a11cb, #2575fc);
            color: #fff;
            padding: 12px 45px;
            font-size: 12px;
            cursor: pointer;
            transition: transform 80ms ease-in;
        }

        button:hover {
            background-image: linear-gradient(to right, #5a0e9d, #1e5bc0);
        }

        .warning-container {
            border: 2px solid rgba(255, 0, 0, 0.5);
            border-radius: 1px;
            padding: 1px;
            margin: 1px 0;
            width: 300px;
            text-align : center;
        }

        .warning {
            color: red;
            font-size: 14px;
        }

        .login-link {
            margin-top: 20px;
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
        <h2>Form Tambah Biodata Admin</h2>
        <div class="warning-container">
            <p class="warning">Anda harus melengkapi biodata sebelum lanjut ke laman Dashboard</p>
        </div>
        <!-- Form untuk menambah data admin -->
        <form action="" method="POST">
            <input type="text" name="nip" placeholder="NIP" required />
            <input type="text" name="nama" placeholder="Nama" required />
            <input type="email" name="email" placeholder="Email" required />
            <input type="tel" name="no_telp" placeholder="Nomor Telepon" required />
            <input type="text" name="alamat" placeholder="Alamat" required />
            <button type="submit">Simpan</button>
        </form>
        <div class="login-link">
            <p><a href="biodata_admin.php">Batal</a></p>
        </div>
    </div>
</body>
</html>
