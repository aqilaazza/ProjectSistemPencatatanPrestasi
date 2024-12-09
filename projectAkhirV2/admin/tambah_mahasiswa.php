<?php
include('../config/connection.php');
include('../models/user.php');
include('../models/mahasiswa.php');

$database = new connection();
$pdo = $database->connect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'nim' => $_POST['nim'],
        'nama_lengkap' => $_POST['nama_lengkap'],
        'email' => $_POST['email'],
        'agama' => $_POST['agama'],
        'nama_ortu' => $_POST['nama_ortu'],
        'alamat' => $_POST['alamat'],
        'no_telp' => $_POST['no_telp'],
        'no_telp_wali' => $_POST['no_telp_wali'],
        'no_telp_ortu' => $_POST['no_telp_ortu'],
        'jenis_kelamin' => $_POST['jenis_kelamin'],
        'tgl_lahir' => $_POST['tgl_lahir'],
        'kota_kelahiran' => $_POST['kota_kelahiran'],
        'tahun_masuk' => $_POST['tahun_masuk'],
        'id_prodi' => $_POST['id_prodi'],
    ];

    $mahasiswa = new mahasiswa($pdo);
    if ($mahasiswa->create($data)) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='biodata_mahasiswa.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mahasiswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
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
        }

        h2 {
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 15px;
            color: #555;
        }

        input, select {
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
        <h2>Form Tambah Biodata Mahasiswa</h2>
        <p>Silakan isi formulir berikut untuk menambahkan data biodata mahasiswa baru:</p>
        <form action="tambah_mahasiswa.php" method="post">
            <input type="text" name="nim" placeholder="NIM" required>
            <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" required>
            <input type="email" name="email" placeholder="Email" required>
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
            <input type="text" name="nama_ortu" placeholder="Nama Orang Tua" required>
            <input type="text" name="alamat" placeholder="Alamat" required>
            <input type="text" name="no_telp" placeholder="Nomor Telepon" required>
            <input type="text" name="no_telp_wali" placeholder="Nomor Telepon Wali" required>
            <input type="text" name="no_telp_ortu" placeholder="Nomor Telepon Orang Tua" required>
            <select id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="">Pilih Jenis Kelamin</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
            <input type="text" name="kota_kelahiran" placeholder="Kota Kelahiran" required>
            <input type="date" id="tgl_lahir" name="tgl_lahir" required>
            <input type="text" name="tahun_masuk" placeholder="Tahun Masuk" required>
            <select id="id_prodi" name="id_prodi" required>
                <option value="">Pilih Program Studi</option>
                <option value="41">D4-Sistem Informasi Bisnis</option>
                <option value="42">D4-Teknik Informatika</option>
            </select>
            <button type="submit">Simpan</button>
        </form>
        <div class="login-link">
            <p><a href="biodata_mahasiswa.php">Batal</a></p>
        </div>
    </div>
</body>
</html>
