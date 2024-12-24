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
    .search-container {
      margin-bottom: 20px;
      text-align: left;
    }
    .search-container input {
      padding: 5px;
      width: 80%;
      margin-right: 5px;
    }
    .search-container button {
      padding: 5px 10px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Prestasi Non Akademik Mahasiswa</h2>

    <!-- Form pencarian berdasarkan NIM -->
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

        // Mengambil parameter NIM dari URL
        $nim = isset($_GET['nim']) ? $_GET['nim'] : '';

        // Query untuk mengambil data dengan status_validasi = 'diterima' dan pencarian berdasarkan NIM
        $query = "SELECT * FROM nonakademik_view";
        if (!empty($nim)) {
            $query .= " WHERE nim LIKE :nim";
        }
        $stmt = $conn->prepare($query);

        // Bind parameter NIM jika ada
        if (!empty($nim)) {
            $stmt->bindValue(':nim', "%$nim%", PDO::PARAM_STR);
        }

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
            <a href="detail_nonakademik.php?nama_kompetisi=<?= urlencode($row['nama_kompetisi']) ?>" class="button">Detail</a>
          </td>
        </tr>
        <?php
            }
        } else {
        ?>
        <tr>
          <td colspan="4" style="text-align: center;">Data tidak ditemukan.</td>
        </tr>
        <?php } ?>
      </tbody>
    </table>

    <div class="login-link">
      <p><a href="../dashboard/dashboardDosen.php">Kembali</a></p>
    </div>
  </div>
</body>
</html>
