<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Validasi Prestasi Non Akademik</title>
  <link rel="stylesheet" href="validasi_prestasi.css">
</head>
<body>
  <div class="container">
    <h2>Validasi Prestasi Non Akademik</h2>
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
          <th>Data</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
      <?php
        // Mengimpor file connection.php
        require_once '../config/connection.php';

        // Membuat instance koneksi
        $db = new connection();
        $conn = $db->connect();

        // Mendapatkan parameter pencarian (jika ada)
        $nim = isset($_GET['nim']) ? $_GET['nim'] : '';

        // Query untuk mengambil data
        $query = "SELECT pn.nim, m.nama_lengkap 
                  FROM prestasi_nonakademik pn 
                  INNER JOIN mahasiswa m ON pn.nim = m.nim";

        if (!empty($nim)) {
            $query .= " WHERE pn.nim LIKE :nim";
        }

        $stmt = $conn->prepare($query);

        // Bind parameter jika ada pencarian
        if (!empty($nim)) {
            $stmt->bindValue(':nim', '%' . $nim . '%', PDO::PARAM_STR);
        }

        // Eksekusi query
        $stmt->execute();

        // Mengambil hasil
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Menampilkan data dalam tabel
        if (!empty($results)):
            foreach ($results as $row):
        ?>
            <tr>
                <td><?= htmlspecialchars($row['nim']) ?></td>
                <td><?= htmlspecialchars($row['nama_lengkap']) ?></td>
                <td>
                    <a href="up_nonakademik.php?nim=<?= urlencode($row['nim']) ?>" class="button">Detail</a>
                </td>
                <td>
                    <div class="status-buttons">
                        <button class="status-button" onclick="handleStatus(this, 'ya', '<?= htmlspecialchars($row['nim']) ?>')">Ya</button>
                        <button class="status-button" onclick="handleStatus(this, 'tidak', '<?= htmlspecialchars($row['nim']) ?>')">Tidak</button>
                    </div>
                </td>
            </tr>
        <?php
            endforeach;
        else:
        ?>
        <tr>
            <td colspan="4" style="text-align: center;">Data tidak ditemukan.</td>
        </tr>
        <?php endif; ?>
</tbody>

    </table>
    <div class="login-link">
        <p><a href="../dashboard/dashboardAdmin.php">Kembali</a></p>
    </div>
  </div>
  <script>
    function handleStatus(button, status, nim) {
    console.log(`Status untuk NIM ${nim} diubah menjadi: ${status}`);

    // Hapus kelas 'clicked' dari tombol lain dalam grup
    const buttons = button.parentElement.querySelectorAll('.status-button');
    buttons.forEach(btn => btn.classList.remove('clicked'));

    // Tambahkan kelas 'clicked' ke tombol yang dipilih
    button.classList.add('clicked');
    }
  </script>
</body>
</html>
