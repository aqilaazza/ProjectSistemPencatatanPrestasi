<?php
session_start(); // Tambahkan ini
include('../config/connection.php');
include('../models/user.php');
include('../models/dosen.php');

// Membuat instance dari kelas connection
$db = new connection();
$pdo = $db->connect();

// Membuat instance dari kelas dosen
$dosenObj = new dosen($pdo);

// Mendapatkan NIDN dari query string
if (!isset($_GET['nidn'])) {
    echo "<script>alert('NIDN tidak ditemukan!'); window.location.href = 'biodata_dosen.php';</script>";
    exit();
}

$nidn = $_GET['nidn'];

// Mendapatkan data dosen berdasarkan NIDN
$dosen = null;
try {
    $query = "SELECT * FROM dosen WHERE nidn = :nidn";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':nidn', $nidn);
    $stmt->execute();
    $dosen = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$dosen) {
        echo "<script>alert('Data dosen tidak ditemukan!'); window.location.href = 'biodata_dosen.php';</script>";
        exit();
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}

// Proses ketika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $no_telp = $_POST['no_telp'];
    $jabatan = $_POST['jabatan'];
    $alamat = $_POST['alamat'];
    $kota_kelahiran = $_POST['kota_kelahiran'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $agama = $_POST['agama'];

    try {
        // Memperbarui data dosen
        $dosenObj->updateDosen($nidn, $nama, $email, $no_telp, $jabatan, $alamat, $kota_kelahiran, $tgl_lahir, $agama);

        // Set pesan ke dalam session
        $_SESSION['success_message'] = "Data dosen berhasil diperbarui!";

        // Redirect ke halaman biodata_dosen.php
        header("Location: biodata_dosen.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Dosen</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
    </style>
</head>
<body>

<div class="container">
    <h1>Edit Data Dosen</h1>

    <form action="" method="post">
        <label for="nidn">NIDN</label>
        <input type="text" id="nidn" name="nidn" value="<?= htmlspecialchars($dosen['nidn']) ?>" readonly>
        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($dosen['nama']) ?>" required>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($dosen['email']) ?>" required>
        <label for="no_telp">No. Telepon</label>
        <input type="text" id="no_telp" name="no_telp" value="<?= htmlspecialchars($dosen['no_telp']) ?>" required>
        <label for="jabatan">Jabatan</label>
        <input type="text" id="jabatan" name="jabatan" value="<?= htmlspecialchars($dosen['jabatan']) ?>" required>
        <label for="alamat">Alamat</label>
        <input type="text" id="alamat" name="alamat" value="<?= htmlspecialchars($dosen['alamat']) ?>" required>
        <label for="kota_kelahiran">Kota Kelahiran</label>
        <input type="text" id="kota_kelahiran" name="kota_kelahiran" value="<?= htmlspecialchars($dosen['kota_kelahiran']) ?>" required>
        <label for="tgl_lahir">Tanggal Lahir</label>
        <input type="date" id="tgl_lahir" name="tgl_lahir" value="<?= htmlspecialchars($dosen['tgl_lahir']) ?>" required>
        <label for="agama">Agama</label>
        <select id="agama" name="agama" required>
            <option value="Islam" <?= $dosen['agama'] === 'Islam' ? 'selected' : '' ?>>Islam</option>
            <option value="Kristen" <?= $dosen['agama'] === 'Kristen' ? 'selected' : '' ?>>Kristen</option>
            <option value="Katolik" <?= $dosen['agama'] === 'Katolik' ? 'selected' : '' ?>>Katolik</option>
            <option value="Hindu" <?= $dosen['agama'] === 'Hindu' ? 'selected' : '' ?>>Hindu</option>
            <option value="Buddha" <?= $dosen['agama'] === 'Buddha' ? 'selected' : '' ?>>Buddha</option>
            <option value="Konghucu" <?= $dosen['agama'] === 'Konghucu' ? 'selected' : '' ?>>Konghucu</option>
        </select>

        <button type="submit" class="btn">Simpan Perubahan</button>
    </form>

    <div class="navbar">
        <a href="biodata_dosen.php">Batal</a>
    </div>
</div>

</body>
</html>
