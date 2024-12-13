<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Validasi Prestasi Non Akademik</title>
  <link rel="stylesheet" href="validasi_prestasi.css">
  <style>
    .status-button {
      background-color: purple;
      color: white;
      border: none;
      padding: 5px 10px;
      border-radius: 5px;
      cursor: pointer;
    }

    .status-button.selected {
      background-color: green;
      color: white;
    }

    .status-button:hover {
      opacity: 0.8;
    }
  </style>
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
          <th>Nama Kompetisi</th>
          <th>Data</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
<?php
require_once '../config/connection.php';
$db = new connection();
$conn = $db->connect();

$nim = isset($_GET['nim']) ? $_GET['nim'] : '';
$query = "SELECT pn.nama_kompetisi, m.nim, pn.status_validasi 
          FROM prestasi_nonakademik pn 
          INNER JOIN mahasiswa m ON pn.nim = m.nim";

if (!empty($nim)) {
    $query .= " WHERE pn.nim LIKE :nim";
}
$stmt = $conn->prepare($query);
if (!empty($nim)) {
    $stmt->bindValue(':nim', '%' . $nim . '%', PDO::PARAM_STR);
}
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!empty($results)):
    foreach ($results as $row):
        $statusValidasi = $row['status_validasi'];
?>
    <tr id="row-<?= htmlspecialchars($row['nama_kompetisi']) ?>">
        <td><?= htmlspecialchars($row['nim']) ?></td>
        <td><?= htmlspecialchars($row['nama_kompetisi']) ?></td>
        <td>
            <a href="up_nonakademik.php?nama_kompetisi=<?= urlencode($row['nama_kompetisi']) ?>" class="button">Detail</a>
        </td>
        <td>
            <div class="status-buttons">
                <button class="status-button <?= $statusValidasi === 'diterima' ? 'selected' : '' ?>" 
                        onclick="handleStatus(this, 'ya', '<?= htmlspecialchars($row['nama_kompetisi']) ?>')">Ya</button>
                <button class="status-button <?= $statusValidasi === 'ditolak' ? 'selected' : '' ?>" 
                        onclick="handleStatus(this, 'tidak', '<?= htmlspecialchars($row['nama_kompetisi']) ?>')">Tidak</button>
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
    function handleStatus(button, status, nama_kompetisi) {
        // Menghapus kelas terpilih dari semua tombol di baris yang sama
        const row = document.getElementById('row-' + nama_kompetisi);
        const buttons = row.querySelectorAll('.status-button');
        buttons.forEach(btn => btn.classList.remove('selected'));

        // Menambahkan kelas "selected" pada tombol yang dipilih
        button.classList.add('selected');

        // Menyiapkan data untuk dikirim ke server
        const formData = new FormData();
        formData.append('nama_kompetisi', nama_kompetisi);
        formData.append('status_validasi', status === 'ya' ? 'diterima' : 'ditolak');

        // Mengirimkan data menggunakan Fetch API
        fetch('update_status.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Status berhasil diperbarui');
            } else {
                console.log('Gagal memperbarui status:', data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
  </script>
</body>
</html>