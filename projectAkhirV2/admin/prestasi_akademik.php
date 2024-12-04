<?php
// Sertakan file koneksi
include('../config/connection.php');

// Menggunakan koneksi PDO
try {
    $pdo = connection();
    
    $sql = "SELECT p.id_akademik, p.nim, m.nama_lengkap, p.semester, p.ip
    FROM prestasi_akademik p 
    JOIN mahasiswa m ON p.nim = m.nim ORDER BY p.id_akademik DESC";
    $stmt = $pdo->prepare($sql); // Memasukkan query ke dalam PDO statement
    $stmt->execute(); // Menjalankan query
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Mengambil hasil dalam bentuk array
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Prestasi Akademik</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Gaya CSS untuk tabel dan navbar */
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
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            max-width: 1200px;
            margin: 0 auto;
            margin-top: 40px;
        }

        h1 {
            font-size: 28px;
            font-weight: 600;
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 15px;
            text-align: center;
            font-size: 16px;
        }

        th {
            background-color: #007bff;
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

        td button {
            background-color: #28a745;
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            margin: 5px;
            transition: background-color 0.3s ease;
        }

        td button:hover {
            background-color: #218838;
        }

        td button.delete {
            background-color: #dc3545;
        }

        td button.delete:hover {
            background-color: #c82333;
        }

        .button-container {
            text-align: center;
            margin-top: 30px;
        }

        .button-container button {
            background-color: #007bff;
            color: white;
            padding: 12px 24px;
            font-size: 18px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin: 5px;
            transition: background-color 0.3s ease;
        }

        .button-container button:hover {
            background-color: #0056b3;
        }

        .button-container i {
            margin-right: 8px;
        }

        .card {
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 22px;
            color: #333;
        }

        .card-body {
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Data Prestasi Akademik</h1>

        <!-- Tabel untuk menampilkan data -->
        <table>
            <thead>
                <tr>
                    <th>ID Akademik</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Semester</th>
                    <th>IP</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result) {
                    foreach ($result as $row) {
                        echo "<tr>";
                        echo "<td>" . $row['id_akademik'] . "</td>";
                        echo "<td>" . $row['nim'] . "</td>";
                        echo "<td>" . $row['nama_lengkap'] . "</td>";
                        echo "<td>" . $row['semester'] . "</td>";
                        echo "<td>" . $row['ip'] . "</td>";
                        echo "<td>
                                <form action='edit_akademik.php' method='get' style='display:inline-block;'>
                                    <input type='hidden' name='id_akademik' value='" . $row['id_akademik'] . "'>
                                    <button type='submit'><i class='fa fa-edit'></i> Edit</button>
                                </form>
                                <form action='hapus_akademik.php' method='get' style='display:inline-block;' onsubmit='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");'>
                                    <input type='hidden' name='id_akademik' value='" . $row['id_akademik'] . "'>
                                    <button type='submit' class='delete'><i class='fa fa-trash'></i> Hapus</button>
                                </form>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Tidak ada data</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Container untuk tombol -->
        <div class="button-container">
            <form action="tambah_akademik.php" method="get">
                <button type="submit">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>Tambah Data
                </button>
            </form>

            <form action="../dashboard/dashboardAdmin.php" method="get">
                <button type="submit">
                    <i class="fa fa-home" aria-hidden="true"></i>Kembali
                </button>
            </form>
        </div>
    </div>

</body>
</html>

<?php
// Menutup koneksi setelah selesai
// Tidak perlu menutup koneksi karena koneksi PDO tidak memerlukan penutupan eksplisit
?>
