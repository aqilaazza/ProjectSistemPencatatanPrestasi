<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="cssAdmin.css">
</head>
<body>

    <div class="sidebar">
        <h2>Dashboard Admin</h2>
        <ul>
            <li><a href="#">Beranda</a></li>
            <li><a href="../admin/biodata_admin.php">Biodata Admin</a></li>
            <li><a href="../admin/biodata_dosen.php">Biodata Dosen</a></li>
            <li><a href="../admin/biodata_mahasiswa.php">Biodata Mahasiswa</a></li>
            <li><a href="../admin/ipMhs.php">Unggah IP Mahasiswa</a></li>
            <li><a href="../admin/validasi_prestasi.php">Validasi Prestasi Non-Akademik</a></li>
            <li><a href="../admin/aturselayang.php">Selayang Pandang</a></li>
            <li><a href="../admin/aturfaq.php">FAQ</a></li>
            <li><a href="#" onclick="confirmLogout()">Keluar</a></li>
        </ul>
    </div>

    <div class="main-content" id="main-content">
        <div class="header">
            <h1>Selamat Datang, [Admin]!</h1>
        </div>

        <div class="card">
            <h2>Jadwal Piket Admin Validator Prestasi.mu</h2>
            <?php
            // Memasukkan file connection.php dari folder config
            require_once '../config/connection.php';

            // Membuat objek dari kelas connection
            $connObj = new connection();

            // Mendapatkan koneksi database
            $conn = $connObj->connect();

            try {
                $stmt = $conn->prepare("SELECT jp.nip, a.nama, jp.hari, jp.jam FROM jadwal_piket jp INNER JOIN admin a ON jp.nip = a.nip");
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (count($result) > 0) {
                    echo '<table class="jadwal-piket-table" id="jadwal-piket-table">';
                    echo '<thead><tr><th>NIP</th><th>Nama</th><th>Hari</th><th>Jam</th><th>Pengaturan</th></tr></thead><tbody>';

                    foreach ($result as $row) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row['nip']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['nama']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['hari']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['jam']) . '</td>';
                        echo '<td><a href="../admin/ubah_piket.php?nip=' . urlencode($row['nip']) . '" class="button-ubah">Ubah</a></td>';
                        echo '</tr>';
                    }

                    echo '</tbody></table>';
                } else {
                    echo '<p>Jadwal Piket Belum Diatur</p>';
                }

                // Menutup koneksi
                $connObj->disconnect();
            } catch (PDOException $e) {
                echo '<p>Terjadi kesalahan: ' . $e->getMessage() . '</p>';
            }
            ?>
            <a href="../admin/tambah_piket.php" class="button-tambah">Tambah Data</a>
        </div>
    </div>

    <script>
        // Logout confirmation function
        function confirmLogout() {
            const confirmed = window.confirm("Apakah Anda yakin keluar?");
            if (confirmed) {
                window.location.href = "../index.php?message=logout";
            } else {
                window.location.href = "../dashboard/dashboardAdmin.php";
            }
        }
    </script>

</body>
</html>