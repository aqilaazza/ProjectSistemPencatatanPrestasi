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
      text-align:left;    }

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
  </style>
</head>
<body>
  <div class="container">
    <h2>Input IP Mahasiswa</h2>

    <!-- Form Pencarian -->
    <form class="search-form" method="GET" action="">
      <label for="search-nim"></label>
      <input type="text" id="search-nim" name="search-nim" placeholder="Masukkan NIM" value="<?php echo isset($_GET['search-nim']) ? htmlspecialchars($_GET['search-nim']) : ''; ?>">
      <button type="submit">Cari</button>
    </form>

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
        include('../config/connection.php');

        $dbConnection = new connection();
        $pdo = $dbConnection->connect();

        // Ambil nilai pencarian
        $searchNim = isset($_GET['search-nim']) ? trim($_GET['search-nim']) : '';

        // Query dengan filter pencarian
        if (!empty($searchNim)) {
          $query = "SELECT nim, nama_lengkap FROM mahasiswa WHERE nim LIKE :nim";
          $stmt = $pdo->prepare($query);
          $stmt->execute([':nim' => "%$searchNim%"]);
        } else {
          $query = "SELECT nim, nama_lengkap FROM mahasiswa";
          $stmt = $pdo->prepare($query);
          $stmt->execute();
        }

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

    <div class="back-button">
      <p><a href="../dashboard/dashboardAdmin.php">Kembali</a></p>
    </div>
  </div>
</body>
</html>
