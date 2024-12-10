<?php
require_once '../config/connection.php';

// Mengecek parameter NIM di URL
if (isset($_GET['nim']) && !empty($_GET['nim'])) {
    $nim = htmlspecialchars($_GET['nim']);
    $db = new Connection();
    $conn = $db->connect();

    // Query untuk mengambil data berdasarkan NIM
    $query = "
        SELECT 
            p.nama_kompetisi,
            p.id_dospem,
            p.nim,
            p.peran,
            p.jenis_kompetisi,
            p.tingkat_kompetisi,
            p.tgl_penyelenggaraan,
            p.foto_kegiatan AS dokumentasi,
            p.sertifikat,
            p.karya,
            p.surat_tugas,
            p.penyelenggara,
            p.peringkat
        FROM 
            prestasi_nonakademik p
        WHERE 
            p.nim = :nim
    ";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':nim', $nim);

    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    $nim = null;
    $data = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Prestasi Non-Akademik</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="up_nonakademik.css">
</head>
<body>
    <div class="container">
        <h2>Data Prestasi Non-Akademik</h2>

        <?php if ($nim): ?>
            <?php if ($data): ?>
                <form>
                    <label for="nama-kompetisi">Nama Kompetisi</label>
                    <input type="text" id="nama-kompetisi" value="<?= htmlspecialchars($data['nama_kompetisi']) ?>" readonly />

                    <label for="id-dosen-pembimbing">ID Dosen Pembimbing</label>
                    <input type="text" id="id-dosen-pembimbing" value="<?= htmlspecialchars($data['id_dospem']) ?>" readonly />

                    <label for="nim">NIM Mahasiswa</label>
                    <input type="text" id="nim" value="<?= htmlspecialchars($data['nim']) ?>" readonly />

                    <label for="peran">Peran</label>
                    <input type="text" id="peran" value="<?= htmlspecialchars($data['peran']) ?>" readonly />

                    <label for="jenis-kompetisi">Jenis Kompetisi</label>
                    <input type="text" id="jenis-kompetisi" value="<?= htmlspecialchars($data['jenis_kompetisi']) ?>" readonly />

                    <label for="tingkat-kompetisi">Tingkat Kompetisi</label>
                    <input type="text" id="tingkat-kompetisi" value="<?= htmlspecialchars($data['tingkat_kompetisi']) ?>" readonly />

                    <label for="tanggal-penyelenggaraan">Tanggal Penyelenggaraan</label>
                    <input type="text" id="tanggal-penyelenggaraan" value="<?= htmlspecialchars($data['tgl_penyelenggaraan']) ?>" readonly />

                    <label for="dokumentasi">Upload Dokumentasi</label>
                    <a href="<?= htmlspecialchars($data['dokumentasi']) ?>" target="_blank">Lihat Dokumentasi</a>
                    <br>

                    <label for="sertifikat">Upload Sertifikat</label>
                    <a href="<?= htmlspecialchars($data['sertifikat']) ?>" target="_blank">Lihat Sertifikat</a>
                    <br>

                    <label for="karya">Upload Karya</label>
                    <a href="<?= htmlspecialchars($data['karya']) ?>" target="_blank">Lihat Karya</a>
                    <br>

                    <label for="surat-tugas">Upload Surat Tugas</label>
                    <a href="<?= htmlspecialchars($data['surat_tugas']) ?>" target="_blank">Lihat Surat Tugas</a>
                    <br>

                    <label for="peringkat">Peringkat</label>
                    <input type="text" id="peringkat" value="<?= htmlspecialchars($data['peringkat']) ?>" readonly />
                    <br>
                </form>
            <?php else: ?>
                <p>Data tidak ditemukan untuk NIM: <?= htmlspecialchars($nim) ?></p>
            <?php endif; ?>
        <?php else: ?>
            <p>Parameter NIM tidak tersedia.</p>
        <?php endif; ?>

        <div class="login-link">
            <p><a href="validasi_prestasi.php">Kembali</a></p>
        </div>
    </div>
</body>
</html>