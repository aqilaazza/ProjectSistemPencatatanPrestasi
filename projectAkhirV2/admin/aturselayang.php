<?php
// Memasukkan file koneksi ke database
include('../config/connection.php');

// Membuat koneksi ke database
$conn = new connection();
$db = $conn->connect();

// Query untuk mengambil data deskripsi dari tabel selayangpandang
$sql = "SELECT * FROM selayang_pandang";
$stmt = $db->prepare($sql);
$stmt->execute();

// Menyimpan hasil query
$selayangPandangData = $stmt->fetch(PDO::FETCH_ASSOC);

// Menutup koneksi
$conn->disconnect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pengaturan Selayang Pandang</title>
  <link rel="stylesheet" href="validasi_prestasi.css">
  <style>
    .button {
      background-color: #0000FF;
      color: white;
      border: none;
      padding: 5px 10px;
      border-radius: 5px;
      cursor: pointer;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }

    .button:hover {
      background-color: #0056b3;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    table, th, td {
      border: 1px solid black;
    }

    th, td {
      padding: 8px;
      text-align: left;
    }

    .search-form {
      margin-bottom: 20px;
      text-align:left;
    }

    .search-form input {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      width: 80%;
    }

    .search-form button {
      padding: 5px 10px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .search-form button:hover {
      background-color: #0056b3;
    }

    .back-button a {
      text-decoration: none;
      color: white;
      background-color: #007bff;
      padding: 10px 20px;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .back-button a:hover {
      background-color: #0056b3;
    }

    .action-buttons {
      display: flex;
      gap: 10px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Pengaturan Selayang Pandang</h2>
    <table>
      <thead>
        <tr>
          <th>Selayang Pandang</th>
          <th>Pengaturan</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($selayangPandangData && !empty($selayangPandangData['deskripsi'])): ?>
          <tr>
            <td><?= htmlspecialchars($selayangPandangData['deskripsi']) ?></td>
            <td>
              <div class="action-buttons">
                <a href="ubah_selayang.php" class="button">Ubah</a>
              </div>
            </td>
          </tr>
        <?php else: ?>
          <tr>
            <td>Selayang Pandang belum dibuat</td>
            <td>
              <div class="action-buttons">
                <a href="input_selayang.php" class="button">Input</a>
                <a href="ubah_selayang.php" class="button">Ubah</a>
              </div>
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>

    <div class="back-button">
      <p><a href="../dashboard/dashboardAdmin.php">Kembali</a></p>
    </div>
  </div>
</body>
</html>