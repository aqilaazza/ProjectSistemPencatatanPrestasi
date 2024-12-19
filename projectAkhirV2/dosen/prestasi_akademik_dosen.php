<?php
// Mengimpor kelas connection
include('../config/connection.php');

// Membuat objek dari kelas connection
$db = new connection();
$conn = $db->connect(); // Mendapatkan koneksi database

// Fungsi untuk menghitung gelar berdasarkan IPK
function hitung_gelar($ipk) {
    if ($ipk >= 3.9 && $ipk <= 4.0) {
        return 'Summa cum laude';
    } elseif ($ipk >= 3.7 && $ipk < 3.9) {
        return 'Magna cum laude';
    } elseif ($ipk >= 3.5 && $ipk < 3.7) {
        return 'Cum laude';
    }
    return '-';
}

// Mengambil parameter NIM dari URL (jika ada)
$nim = isset($_GET['nim']) ? $_GET['nim'] : '';

// Query untuk mengambil data mahasiswa dan prestasi akademik
$sql = "SELECT m.nim, m.nama_lengkap, 
            AVG(CAST(pa.ip AS DECIMAL(4, 2))) AS ipk
        FROM mahasiswa m
        JOIN prestasi_akademik pa ON m.nim = pa.nim";

// Menambahkan kondisi pencarian berdasarkan NIM jika ada
if (!empty($nim)) {
    $sql .= " WHERE m.nim LIKE :nim";
}

$sql .= " GROUP BY m.nim, m.nama_lengkap";

// Menambahkan kondisi HAVING untuk hanya menampilkan IPK >= 3.5
$sql .= " HAVING AVG(CAST(pa.ip AS DECIMAL(4, 2))) >= 3.5";

// Menyiapkan dan mengeksekusi query
$stmt = $conn->prepare($sql);

// Jika ada pencarian berdasarkan NIM
if (!empty($nim)) {
    $stmt->bindValue(':nim', "%$nim%", PDO::PARAM_STR);
}

$stmt->execute();

// Menyimpan hasil query dalam array
$prestasi_akademik = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Validasi Prestasi Akademik</title>
  <link rel="stylesheet" href="prestasi_akademik_dosen.css">
</head>
<body>
  <div class="container">
    <h2>Prestasi Akademik Mahasiswa</h2>
    <div class="search-container">
      <form method="GET" action="">
        <input type="text" name="nim" placeholder="Cari berdasarkan NIM" value="<?= isset($_GET['nim']) ? htmlspecialchars($_GET['nim']) : '' ?>">
        <button type="submit" class="button">Cari</button>
      </form>
    </div>
    <table>
      <thead>
        <tr>
          <th>NIM</th>
          <th>Nama</th>
          <th>IPK</th>
          <th>Gelar</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($prestasi_akademik as $row): ?>
        <tr>
          <td><?= htmlspecialchars($row['nim']) ?></td>
          <td><?= htmlspecialchars($row['nama_lengkap']) ?></td>
          <td><?= number_format($row['ipk'], 2) ?></td>
          <td><?= hitung_gelar($row['ipk']) ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
