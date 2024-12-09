<?php
// Sertakan file koneksi dan dosen
include('../config/connection.php');
include('../models/user.php');
include('../models/dosen.php');

// Membuat instance dari kelas connection
$db = new connection();
$pdo = $db->connect();

// Membuat instance dari kelas dosen
$dosenObj = new dosen($pdo);

// Mendapatkan data dosen
try {
    $result = $dosenObj->getAll(); // Fungsi untuk mengambil semua data dosen
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}

if (isset($_SESSION['success_message'])) {
    echo "<script>alert('" . $_SESSION['success_message'] . "');</script>";
    unset($_SESSION['success_message']); // Hapus pesan setelah ditampilkan
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Dosen</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Styling CSS tetap sama seperti sebelumnya */
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
            max-width: 3000px;
            margin: 0 auto;
        }

        h1 {
            font-size: 26px;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
        }

        th, td {
            padding: 14px 20px;
            text-align: left;
            border: 1px solid #ddd;
            font-size: 16px;
        }

        th {
            background-color: blue;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .btn {
            padding: 8px 20px;
            margin: 5px;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            text-align: center;
            display: inline-block;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-edit {
            background-color: #28a745;
        }

        .btn-edit:hover {
            background-color: #218838;
            transform: scale(1.1);
        }

        .btn-delete {
            background-color: #dc3545;
        }

        .btn-delete:hover {
            background-color: #c82333;
            transform: scale(1.1);
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
        }

    </style>
</head>
<body>

<div class="container">
    <h1>Data Dosen</h1>

    <table>
        <thead>
            <tr>
                <th>NIDN</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No. Telepon</th>
                <th>Jabatan</th>
                <th>Alamat</th>
                <th>Kota Kelahiran</th>
                <th>Tanggal Lahir</th>
                <th>Agama</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result): ?>
                <?php foreach ($result as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['nidn']) ?></td>
                        <td><?= htmlspecialchars($row['nama']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars($row['no_telp']) ?></td>
                        <td><?= htmlspecialchars($row['jabatan']) ?></td>
                        <td><?= htmlspecialchars($row['alamat']) ?></td>
                        <td><?= htmlspecialchars($row['kota_kelahiran']) ?></td>
                        <td><?= htmlspecialchars(date('d-m-Y', strtotime($row['tgl_lahir']))) ?></td>
                        <td><?= htmlspecialchars($row['agama']) ?></td>
                        <td>
                            <form action="/projectAkhirV2/admin/edit_dosen.php" method="get" style="display:inline-block;">
                                <input type="hidden" name="nidn" value="<?= htmlspecialchars($row['nidn']) ?>">
                                <button type="submit" class="btn btn-edit">
                                    <i class="fa fa-edit"></i> Edit
                                </button>
                            </form>
                            <form action="hapus_dosen.php" method="get" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                <input type="hidden" name="nidn" value="<?= htmlspecialchars($row['nidn']) ?>">
                                <button type="submit" class="btn btn-delete">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="10">Tidak ada data dosen</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="navbar">
        <a href="/projectAkhirV2/admin/tambah_dosen.php">Tambah Data</a>
        <a href="../dashboard/dashboardAdmin.php">Kembali</a>
    </div>
</div>

</body>
</html>

<?php
// Menutup koneksi
$pdo = null;
?>
