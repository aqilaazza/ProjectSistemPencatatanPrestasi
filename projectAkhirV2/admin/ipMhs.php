<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Prestasi Non Akademik Diterima</title>
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
    }
    .button:hover {
      background-color: #0000FF;
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
  </style>
</head>
<body>
  <div class="container">
    <h2>Input IP Mahasiswa</h2>
    <table>
      <thead>
        <tr>
          <th>NIM</th>
          <th>Nama Lengkap</th>
          <th>IP Semester</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Sertakan koneksi ke database
        include('../config/connection.php');

        // Buat koneksi ke database
        $dbConnection = new connection();
        $pdo = $dbConnection->connect();

        // Query untuk mendapatkan data mahasiswa
        $query = "SELECT nim, nama_lengkap FROM mahasiswa";
        $stmt = $pdo->prepare($query);
        $stmt->execute();

        // Tampilkan data dalam tabel
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo "<tr>";
          echo "<td>" . htmlspecialchars($row['nim']) . "</td>";
          echo "<td>" . htmlspecialchars($row['nama_lengkap']) . "</td>";
          echo "<td><a class='button' href='lihat_ip_mhs.php?nim=" . urlencode($row['nim']) . "'>Lihat</a>
                    <a class='button' href='input_ip_mhs.php?nim=" . urlencode($row['nim']) . "'>Input</a>
                    <a class='button' href='ubah_ip_mhs.php?nim=" . urlencode($row['nim']) . "'>Ubah</a>
                </td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
    <div class="login-link">
      <p><a href="../dashboard/dashboardAdmin.php">Kembali</a></p>
    </div>
  </div>
</body>
</html>