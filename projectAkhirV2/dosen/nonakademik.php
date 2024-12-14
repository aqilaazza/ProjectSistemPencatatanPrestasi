<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Prestasi Non Akademik Diterima</title>
  <link rel="stylesheet" href="../admin/validasi_prestasi.css">
  <style>
    .button {
      background-color: #0000FF;
      color: white;
      border: none;
      padding: 5px 10px;
      border-radius: 5px;
      cursor: pointer;
      text-decoration: none;
    }
    .button:hover {
      background-color: #0000FF;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Prestasi Non Akademik Mahasiwa</h2>
    <table>
      <thead>
        <tr>
          <th>NIM</th>
          <th>Nama Lengkap</th>
          <th>Nama Kompetisi</th>
          <th>Data</th>
        </tr>
      </thead>
      <tbody>
        <?php
        require_once '../config/connection.php';

        // Koneksi ke database
        $db = new connection();
        $conn = $db->connect();

        // Query untuk mengambil data dengan status_validasi = 'diterima'
        $query = "SELECT p.nim, m.nama_lengkap, p.nama_kompetisi
        FROM prestasi_nonakademik p
        INNER JOIN mahasiswa m
        ON m.nim = p.nim
        WHERE status_validasi = 'diterima'";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($results)) {
            foreach ($results as $row) {
        ?>
        <tr>
          <td><?= htmlspecialchars($row['nim']) ?></td>
          <td><?= htmlspecialchars($row['nama_lengkap']) ?></td>
          <td><?= htmlspecialchars($row['nama_kompetisi']) ?></td>
          <td>
            <a href="../admin/up_nonakademik.php?nama_kompetisi=<?= urlencode($row['nama_kompetisi']) ?>" class="button">Detail</a>
          </td>
        </tr>
        <?php
            }
        } else {
        ?>
        <tr>
          <td colspan="3" style="text-align: center;">Data tidak ditemukan.</td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <div class="login-link">
      <p><a href="../dashboard/dashboardAdmin.php">Kembali</a></p>
    </div>
  </div>
</body>
</html>