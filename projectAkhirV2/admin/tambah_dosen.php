<?php
// Sertakan file koneksi dan model dosen
include('../config/connection.php');
include('../models/user.php');
include('../models/dosen.php');

// Membuat instance dari kelas connection
$db = new connection();
$pdo = $db->connect();

// Membuat instance dari kelas dosen
$dosenObj = new dosen($pdo);

// Proses ketika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nidn = $_POST['nidn'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $no_telp = $_POST['no_telp'];
    $jabatan = $_POST['jabatan'];
    $alamat = $_POST['alamat'];
    $kota_kelahiran = $_POST['kota_kelahiran'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $agama = $_POST['agama'];

    // Pastikan mengirimkan 9 parameter
    if ($dosenObj->addDosen($nidn, $nama, $email, $no_telp, $jabatan, $alamat, $kota_kelahiran, $tgl_lahir, $agama)) {
        header("Location: biodata_dosen.php?message=added");
        exit();
    } else {
        echo "<p style='color: red; text-align: center;'>Gagal menyimpan data. Silakan coba lagi.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Dosen</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
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
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        h1 {
            font-size: 26px;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 10px;
            font-weight: bold;
        }

        input, select {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 16px;
        }

        .btn {
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #2A6BF8;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #1E4CB5;
        }

        .navbar {
            text-align: center;
            margin-top: 20px;
        }

        .navbar a {
            text-decoration: none;
            padding: 10px 20px;
            background-color: #2A6BF8;
            color: white;
            border-radius: 5px;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: #333;
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
    <h1>Form Tambah Biodata Dosen</h1>
    <form action="" method="post">
        <label for="nidn">NIDN</label>
        <input type="text" id="nidn" name="nidn" required>
        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" required>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
        <label for="no_telp">No. Telepon</label>
        <input type="text" id="no_telp" name="no_telp" required>
        <label for="jabatan">Jabatan</label>
        <input type="text" id="jabatan" name="jabatan" required>
        <label for="alamat">Alamat</label>
        <input type="text" id="alamat" name="alamat" required>
        <label for="kota_kelahiran">Kota Kelahiran</label>
        <input type="text" id="kota_kelahiran" name="kota_kelahiran" required>
        <label for="tgl_lahir">Tanggal Lahir</label>
        <input type="date" id="tgl_lahir" name="tgl_lahir" required>
        <label for="agama">Agama</label>
        <select id="agama" name="agama" required>
            <option value="">Pilih Agama</option>
            <option value="Islam">Islam</option>
            <option value="Kristen Katolik">Kristen Katolik</option>
            <option value="Kristen Protestan">Kristen Protestan</option>
            <option value="Hindu">Hindu</option>
            <option value="Buddha">Buddha</option>
            <option value="Konghucu">Konghucu</option>
            <option value="Lainnya">Lainnya</option>
        </select>


        <button type="submit" class="btn">Simpan</button>
    </form>

    <div class="login-link">
            <p><a href="biodata_dosen.php">Batal</a></p>
        </div>
</div>

</body>
</html>
