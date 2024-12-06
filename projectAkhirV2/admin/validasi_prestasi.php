<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Validasi Prestasi Non Akademik</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-image: url('../img/bg.png');
    }

    .container {
      background-color: #fff;
      width: 50%;
      margin: 20px auto;
      border: 1px solid #000;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      text-align: center;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 10px;
      color: #333;
    }

    table, th, td {
      border: 1px solid black;
    }

    th, td {
      padding: 10px;
      text-align: center;
    }

    th {
      background-color: #0000FF; /* Latar belakang biru */
      color: #FFFFFF; /* Teks putih */
      font-weight: bold; /* Membuat teks lebih tebal */
    }

    .button {
      padding: 5px 10px;
      background-color: #0000FF;
      color: #fff;
      text-decoration: none;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .button:hover {
      background-color: #0056b3;
    }

    .search-container {
      margin-bottom: 10px;
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
        // Data dummy, bisa diganti dengan data dari database
        $data = [
            ['nim' => '123', 'nama' => 'Reza', 'data' => 'Detail', 'status' => 'Belum divalidasi'],
            ['nim' => '124', 'nama' => 'Ali', 'data' => 'Detail', 'status' => 'Valid'],
            ['nim' => '125', 'nama' => 'Siti', 'data' => 'Detail', 'status' => 'Belum divalidasi'],
        ];

        $searchNIM = isset($_GET['nim']) ? $_GET['nim'] : '';

        foreach ($data as $row) {
            if ($searchNIM && strpos($row['nim'], $searchNIM) === false) {
                continue;
            }
            echo "<tr>
                <td>{$row['nim']}</td>
                <td>{$row['nama']}</td>
                <td><button class='button' onclick='showDetails()'>{$row['data']}</button></td>
                <td>{$row['status']}</td>
              </tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <script>
    function showDetails() {
      alert("Menampilkan detail data.");
    }
  </script>
</body>
</html>
