<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Validasi Prestasi Non Akademik</title>
  <link rel="stylesheet" href="validasi_prestasi.css">
  <style>
    .status-button {
      background-color: #007bff; /* Default color set to blue */
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 14px;
      transition: all 0.2s ease;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2); /* Shadow effect */
    }

    .status-button:hover {
      background-color: #28a745; /* Change color to green on hover */
    }

    .status-button:active {
      transform: scale(0.95); /* Shrink effect when clicked */
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3); /* Shadow effect when clicked */
    }

    /* If the button is selected (clicked) */
    .status-button.selected {
      background-color: #28a745; /* Green when selected */
      color: white;
      box-shadow: none; /* Remove shadow after selection */
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
        // Remove the 'selected' class from all buttons in the same row
        const row = document.getElementById('row-' + nama_kompetisi);
        const buttons = row.querySelectorAll('.status-button');
        buttons.forEach(btn => btn.classList.remove('selected'));

        // Add the 'selected' class to the clicked button
        button.classList.add('selected');

        // Prepare the data to send to the server
        const formData = new FormData();
        formData.append('nama_kompetisi', nama_kompetisi);
        formData.append('status_validasi', status === 'ya' ? 'diterima' : 'ditolak');

        // Send the data using Fetch API
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
