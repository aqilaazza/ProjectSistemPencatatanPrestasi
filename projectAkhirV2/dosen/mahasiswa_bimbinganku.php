<?php
require_once '../config/connection.php'; // Mengimpor koneksi database

// Membuat instance dari class connection
$connInstance = new connection();
$conn = $connInstance->connect();

// Memulai sesi untuk mendapatkan NIDN yang sedang login
session_start();
if (!isset($_SESSION['nidn'])) {
    header("Location: ../login.php");
    exit;
}
$nidn = $_SESSION['nidn'];

// Query untuk mendapatkan data berdasarkan kondisi
$sql = "SELECT pn.id_dospem, m.nim, m.nama_lengkap, pn.nama_kompetisi, pn.jenis_kompetisi, 
               pn.tingkat_kompetisi, pn.peringkat, pn.tgl_penyelenggaraan
        FROM prestasi_nonakademik pn
        INNER JOIN mahasiswa m ON pn.nim = m.nim
        INNER JOIN dosen_pembimbing dp ON pn.id_dospem = dp.id_dospem
        WHERE pn.status_validasi = 'diterima' AND dp.nidn = :nidn";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':nidn', $nidn, PDO::PARAM_STR);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peran Dosen Pembimbing</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-image: url('../img/bg.png');
            background-size: cover;
            background-position: center;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 40px 10px;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: black;
        }

        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
            background-color: #fff;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: blue;
            color: white;
            font-weight: 600;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .navbar {
            text-align: center;
            margin-top: 20px;
            gap: 20px;
        }

        .navbar a {
            text-decoration: none;
            padding: 10px 5px;
            width: 150px;
            display: inline-block;
            text-align: center;
            background-color: #2A6BF8;
            color: white;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .navbar a:hover {
            background-color: #0056d2;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Mahasiswa Bimbinganku</h1>
        <table>
            <thead>
                <tr>
                    <th>ID Dospem</th>
                    <th>NIM</th>
                    <th>Nama Lengkap</th>
                    <th>Nama Kompetisi</th>
                    <th>Jenis Kompetisi</th>
                    <th>Tingkat Kompetisi</th>
                    <th>Peringkat</th>
                    <th>Tanggal Penyelenggaraan</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($data) > 0): ?>
                    <?php foreach ($data as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id_dospem']); ?></td>
                            <td><?= htmlspecialchars($row['nim']); ?></td>
                            <td><?= htmlspecialchars($row['nama_lengkap']); ?></td>
                            <td><?= htmlspecialchars($row['nama_kompetisi']); ?></td>
                            <td><?= htmlspecialchars($row['jenis_kompetisi']); ?></td>
                            <td><?= htmlspecialchars($row['tingkat_kompetisi']); ?></td>
                            <td><?= htmlspecialchars($row['peringkat']); ?></td>
                            <td><?= htmlspecialchars($row['tgl_penyelenggaraan']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" style="text-align: center;">Tidak ada data yang tersedia</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="navbar">
            <a href="lihat_peran.php">Kembali</a>
        </div>
    </div>
</body>
</html>