<?php
include('../config/connection.php');
include('../models/user.php');
include('../models/mahasiswa.php');

$message = '';
try {
    // Membuat instance dari class connection dan user
    $dbConnection = new connection();
    $pdo = $dbConnection->connect(); // Membuka koneksi menggunakan metode connect()
    
    // Membuat instance dari class mahasiswa (yang sudah extend class user)
    $mahasiswa = new mahasiswa($pdo);
    
    // Mengambil semua data mahasiswa dengan metode getAll dari class user
    $result = $mahasiswa->getAll();
} catch (Exception $e) {
    echo "Terjadi kesalahan: " . $e->getMessage();
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Styling CSS Anda tetap sama */
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

        /* Styling untuk tabel */
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

        /* Tombol Edit */
        .btn-edit {
            background-color: #28a745; /* Hijau untuk Edit */
        }

        .btn-edit:hover {
            background-color: #218838;
            transform: scale(1.1);
        }

        /* Tombol Hapus */
        .btn-delete {
            background-color: #dc3545; /* Merah untuk Hapus */
        }

        .btn-delete:hover {
            background-color: #c82333;
            transform: scale(1.1);
        }

        .btn i {
            margin-right: 8px; /* Jarak antara ikon dan teks */
        }

        .navbar {
            text-align: center;
            margin-top: 20px;
        }

        .navbar a {
            text-decoration: none;
            padding: 10px 20px;
            background-color: blue;
            color: white;
            border-radius: 5px;
        }

        .navbar a:hover {
            background-color: #ddd;
        }

        .error, .success-message {
            margin: 10px 0;
            font-size: 14px;
            padding: 10px;
            border-radius: 5px;
            display: block; /* Pastikan terlihat */
            text-align: center;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .success-message {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }


    </style>
</head>
<body>

<div class="container">
        <h1>Data Mahasiswa</h1>

        <?php if (isset($_GET['message'])) : ?>
            <div class="success-message">
                <?php 
                    if ($_GET['message'] == 'added') {
                        echo "Data berhasil ditambahkan!";
                    } elseif ($_GET['message'] == 'updated') {
                        echo "Data berhasil diperbarui!";
                    } elseif ($_GET['message'] == 'deleted') {
                        echo "Data berhasil dihapus!";
                    }
                ?>
            </div>
        <?php endif; ?>

        <!-- Tabel untuk menampilkan data mahasiswa -->
        <table>
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>No. Telepon</th>
                    <th>Agama</th>
                    <th>Nama Orang Tua</th>
                    <th>Jenis Kelamin</th>
                    <th>Kota Kelahiran</th>
                    <th>Tanggal Lahir</th>
                    <th>Tahun Masuk</th>
                    <th>Program Studi</th>
                    <th>No. Telepon Orang Tua</th>
                    <th>No. Telepon Wali</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($result)) {
                    foreach ($result as $row) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['nim']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nama_lengkap']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['no_telp']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['agama']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nama_ortu']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['jenis_kelamin']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['kota_kelahiran']) . "</td>";

                        $tgl_lahir = date('d-m-Y', strtotime($row['tgl_lahir']));
                        echo "<td>" . htmlspecialchars($tgl_lahir) . "</td>";

                        echo "<td>" . htmlspecialchars($row['tahun_masuk']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nama_prodi']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['no_telp_ortu']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['no_telp_wali']) . "</td>";

                        // Tombol Aksi
                        echo "<td>
                                <form action='edit_mahasiswa.php' method='get' style='display:inline-block;'>
                                    <input type='hidden' name='nim' value='" . htmlspecialchars($row['nim']) . "'>
                                    <button type='submit' class='btn btn-edit'>
                                        <i class='fa fa-edit'></i> Edit
                                    </button>
                                </form>
                                <form action='../fungsi/hapus.php' method='post' style='display:inline-block;' onsubmit='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");'>
                                    <input type='hidden' name='id' value='" . htmlspecialchars($row['nim']) . "'>
                                    <input type='hidden' name='type' value='mahasiswa'>
                                    <button type='submit' class='btn btn-delete'><i class='fa fa-trash'></i> Hapus</button>
                                </form>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='14'>Tidak ada data mahasiswa</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Tombol kembali -->
        <div class="navbar">
            <a href="../admin/tambah_mahasiswa.php">Tambah Data</a>
        </div>
        <div class="navbar">
            <a href="../dashboard/dashboardAdmin.php">Kembali</a>
        </div>
    </div>

</body>
</html>

<?php
// Menutup koneksi setelah
