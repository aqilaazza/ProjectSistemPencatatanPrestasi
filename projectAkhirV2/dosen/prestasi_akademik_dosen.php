<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Validasi Prestasi Akademik</title>
  <link rel="stylesheet" href="prestasi_akademik_dosen.css">
</head>
<body>
  <div class="container">
    <h2>Prestasi Akademik Mahasiswa</h2>
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
          <?php for ($i = 1; $i <= 8; $i++): ?>
            <th>Smt <?= $i ?></th>
          <?php endfor; ?>
        </tr>
      </thead>
      <tbody>
    
</tbody>
    </table>
  </div>
</body>
</html>
