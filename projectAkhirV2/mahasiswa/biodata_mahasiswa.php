<?php
session_start();

// Pastikan mahasiswa sudah login
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'mahasiswa') {
    die("Akses ditolak. Anda harus login terlebih dahulu.");
}

// Ambil data mahasiswa dari session
$nim = $_SESSION['nim'];
$nama = $_SESSION['nama'];

require_once '../config/connection.php';
$conn = (new connection())->connect();
$query = "SELECT * FROM mahasiswa WHERE nim = :nim";
$stmt = $conn->prepare($query);
$stmt->bindParam(':nim', $nim);
$stmt->execute();
$mahasiswa = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$mahasiswa) {
    die("Data mahasiswa tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Biodata Mahasiswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="biodata_mahasiswa.css">
</head>
<body>
    <div class="container">
        <h2>Edit Biodata Mahasiswa</h2>
        <form action="process_edit_biodata.php" method="POST">
            <input type="hidden" name="nim" value="<?php echo htmlspecialchars($mahasiswa['nim']); ?>" />

            <input type="text" name="nama" placeholder="Nama Lengkap" value="<?php echo htmlspecialchars($mahasiswa['nama_lengkap']); ?>" required />
            <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($mahasiswa['email']); ?>" required />
            <select name="agama" required>
                <option value="Islam" <?php echo $mahasiswa['agama'] == 'Islam' ? 'selected' : ''; ?>>Islam</option>
                <option value="Kristen" <?php echo $mahasiswa['agama'] == 'Kristen' ? 'selected' : ''; ?>>Kristen</option>
                <option value="Hindu" <?php echo $mahasiswa['agama'] == 'Hindu' ? 'selected' : ''; ?>>Hindu</option>
                <option value="Buddha" <?php echo $mahasiswa['agama'] == 'Buddha' ? 'selected' : ''; ?>>Buddha</option>
                <option value="Konghucu" <?php echo $mahasiswa['agama'] == 'Konghucu' ? 'selected' : ''; ?>>Konghucu</option>
            </select>
            <input type="text" name="alamat" placeholder="Alamat" value="<?php echo htmlspecialchars($mahasiswa['alamat']); ?>" required />
            <input type="text" name="no_telp" placeholder="No. Telp" value="<?php echo htmlspecialchars($mahasiswa['no_telp']); ?>" required />
            <input type="text" name="no_telp_wali" placeholder="No. Telp Wali" value="<?php echo htmlspecialchars($mahasiswa['no_telp_wali']); ?>" required />
            <input type="text" name="no_telp_ortu" placeholder="No. Telp Orang Tua" value="<?php echo htmlspecialchars($mahasiswa['no_telp_ortu']); ?>" required />
            <input type="text" name="jenis_kelamin" placeholder="Jenis Kelamin" value="<?php echo htmlspecialchars($mahasiswa['jenis_kelamin']); ?>" required />
            <input type="text" name="tgl_lahir" placeholder="Tanggal Lahir" value="<?php echo htmlspecialchars($mahasiswa['tgl_lahir']); ?>" required />
            <input type="text" name="kota_kelahiran" placeholder="Kota Kelahiran" value="<?php echo htmlspecialchars($mahasiswa['kota_kelahiran']); ?>" required />
            <input type="text" name="tahun_masuk" placeholder="Tahun Masuk" value="<?php echo htmlspecialchars($mahasiswa['tahun_masuk']); ?>" required />

            <button type="submit">Simpan</button>
        </form>

        <div class="login-link">
            <p><a href="profil_mahasiswa.php">Kembali</a></p>
        </div>
    </div>
</body>
</html>
