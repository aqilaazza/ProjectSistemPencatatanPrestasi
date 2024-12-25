<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tampilan FAQ</title>
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

    .back-button {
      display: flex;
      justify-content: center;
      gap: 10px;
      margin-top: 20px;
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

    .no-data {
      text-align: center;
      font-size: 16px;
      margin: 20px 0;
      color: #666;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Tampilan FAQ</h2>
    <table>
      <thead>
        <tr>
          <th>ID FAQ</th>
          <th>Pertanyaan</th>
          <th>Jawaban</th>
          <th>Pengaturan</th>
        </tr>
      </thead>
      <tbody>
        <?php
        require_once '../config/connection.php';

        try {
          $db = (new connection())->connect();
          $query = "SELECT * FROM faq";
          $stmt = $db->query($query);
          $faqs = $stmt->fetchAll(PDO::FETCH_ASSOC);

          if (empty($faqs)) {
            echo '<tr><td colspan="4" class="no-data">Belum ada FAQ yang diinputkan.</td></tr>';
          } else {
            foreach ($faqs as $faq) {
              echo "<tr>";
              echo "<td>" . htmlspecialchars($faq['id_faq']) . "</td>";
              echo "<td>" . htmlspecialchars($faq['pertanyaan']) . "</td>";
              echo "<td>" . htmlspecialchars($faq['jawaban']) . "</td>";
              echo "<td><a href='ubah_faq.php?id=" . $faq['id_faq'] . "' class='button'>Ubah</a></td>";
              echo "</tr>";
            }
          }
        } catch (PDOException $e) {
          echo '<tr><td colspan="4" class="no-data">Terjadi kesalahan: ' . htmlspecialchars($e->getMessage()) . '</td></tr>';
        }
        ?>
      </tbody>
    </table>

    <div class="back-button">
      <a href="../dashboard/dashboardAdmin.php">Kembali</a>
      <a href="input_faq.php">Tambah Data</a>
    </div>
  </div>
</body>
</html>