<?php
include('../config/connection.php');
include('../models/user.php');
include('../models/mahasiswa.php');

// Memanggil objek dari kelas connection untuk mendapatkan koneksi PDO
$conn = new connection();
$pdo = $conn->connect();

// Periksa apakah NIM ada di URL
if (!isset($_GET['nim'])) {
    die("NIM tidak ditemukan.");
}

$nim = $_GET['nim'];
$mahasiswa = new Mahasiswa($pdo);

try {
    $sql = "SELECT * FROM mahasiswa WHERE nim = :nim";
    $query = $pdo->prepare($sql);
    $query->bindParam(':nim', $nim);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_ASSOC);

    if (!$data) {
        die("Data mahasiswa tidak ditemukan.");
    }
} catch (PDOException $e) {
    die("Kesalahan: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $no_telp = $_POST['no_telp'];
    $agama = $_POST['agama'];
    $nama_ortu = $_POST['nama_ortu'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $kota_kelahiran = $_POST['kota_kelahiran'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $tahun_masuk = $_POST['tahun_masuk'];
    $id_prodi = $_POST['id_prodi'] ?: $data['id_prodi']; 
    $no_telp_ortu = $_POST['no_telp_ortu'];
    $no_telp_wali = $_POST['no_telp_wali'];

    try {
        $updateData = [
            'nama_lengkap' => $nama_lengkap,
            'email' => $email,
            'no_telp' => $no_telp,
            'agama' => $agama,
            'nama_ortu' => $nama_ortu,
            'jenis_kelamin' => $jenis_kelamin,
            'kota_kelahiran' => $kota_kelahiran,
            'tgl_lahir' => $tgl_lahir,
            'tahun_masuk' => $tahun_masuk,
            'id_prodi' => $id_prodi,  
            'no_telp_ortu' => $no_telp_ortu,
            'no_telp_wali' => $no_telp_wali
        ];

        $result = $mahasiswa->update($nim, $updateData);

        if ($result) {
            header("Location: biodata_mahasiswa.php?message=updated");
            exit();
        } else {
            $error = "Gagal memperbarui data mahasiswa.";
        }
    } catch (PDOException $e) {
        $error = "Kesalahan: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mahasiswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-image: url('../img/bg.png');
            background-size: cover;
            background-position: center;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 40px 10px;
        }

        .container {
            width: 90%;
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: black;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-size: 14px;
            font-weight: 500;
        }

        input, textarea, button {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        button {
            background-image: linear-gradient(to right, #6a11cb, #2575fc);
            color: white;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background-image: linear-gradient(to right, #5a0e9d, #1e5bc0);

        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: -10px;
        }

        .success-message {
            background-color: #4CAF50; /* Green */
            color: white;
            padding: 10px;
            text-align: center;
            margin-bottom: 20px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Data Mahasiswa</h1>
        
        <!-- Menampilkan pesan error jika ada -->
        <?php if (isset($error)) : ?>
            <p class="error"><?= htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form method="POST">
            <label for="nama_lengkap">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" id="nama_lengkap" value="<?= htmlspecialchars($data['nama_lengkap']); ?>" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?= htmlspecialchars($data['email']); ?>" required>

            <label for="no_telp">No Telepon</label>
            <input type="text" name="no_telp" id="no_telp" value="<?= htmlspecialchars($data['no_telp']); ?>" required>

            <label for="agama">Agama</label>
            <select id="agama" name="agama" required>
                <option value="">Pilih Agama</option>
                <option value="Islam" <?= $data['agama'] == 'Islam' ? 'selected' : '' ?>>Islam</option>
                <option value="Kristen Katolik" <?= $data['agama'] == 'Kristen Katolik' ? 'selected' : '' ?>>Kristen Katolik</option>
                <option value="Kristen Protestan" <?= $data['agama'] == 'Kristen Protestan' ? 'selected' : '' ?>>Kristen Protestan</option>
                <option value="Hindu" <?= $data['agama'] == 'Hindu' ? 'selected' : '' ?>>Hindu</option>
                <option value="Buddha" <?= $data['agama'] == 'Buddha' ? 'selected' : '' ?>>Buddha</option>
                <option value="Konghucu" <?= $data['agama'] == 'Konghucu' ? 'selected' : '' ?>>Konghucu</option>
                <option value="Lainnya" <?= $data['agama'] == 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
            </select>

            <label for="nama_ortu">Nama Orang Tua</label>
            <input type="text" name="nama_ortu" id="nama_ortu" value="<?= htmlspecialchars($data['nama_ortu']); ?>" required>

            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="">Pilih Jenis Kelamin</option>
                <option value="L" <?= $data['jenis_kelamin'] == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                <option value="P" <?= $data['jenis_kelamin'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
            </select>

            <label for="kota_kelahiran">Kota Kelahiran</label>
            <input type="text" name="kota_kelahiran" id="kota_kelahiran" value="<?= htmlspecialchars($data['kota_kelahiran']); ?>" required>

            <label for="tgl_lahir">Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" id="tgl_lahir" value="<?= htmlspecialchars($data['tgl_lahir']); ?>" required>

            <label for="tahun_masuk">Tahun Masuk</label>
            <input type="text" name="tahun_masuk" id="tahun_masuk" value="<?= htmlspecialchars($data['tahun_masuk']); ?>" required>

            <label for="id_prodi">Program Studi</label>
            <select id="id_prodi" name="id_prodi" required>
                <option value="41" <?= (isset($_POST['id_prodi']) && $_POST['id_prodi'] == 41) || (!isset($_POST['id_prodi']) && $data['id_prodi'] == 41) ? 'selected' : ''; ?>>D4-Sistem Informasi Bisnis</option>
                <option value="42" <?= (isset($_POST['id_prodi']) && $_POST['id_prodi'] == 42) || (!isset($_POST['id_prodi']) && $data['id_prodi'] == 42) ? 'selected' : ''; ?>>D4-Teknik Informatika</option>
            </select>

            <label for="no_telp_ortu">No Telepon Orang Tua</label>
            <input type="text" name="no_telp_ortu" id="no_telp_ortu" value="<?= htmlspecialchars($data['no_telp_ortu']); ?>" required>

            <label for="no_telp_wali">No Telepon Wali</label>
            <input type="text" name="no_telp_wali" id="no_telp_wali" value="<?= htmlspecialchars($data['no_telp_wali']); ?>" required>

            <button type="submit">Simpan Perubahan</button>
        </form>

        <div style="text-align: center; margin-top: 20px;">
            <a href="biodata_mahasiswa.php" style="text-decoration: none; color: #FF416C; text-decoration: underline;"> Kembali</a>
        </div>
    </div>
</body>
</html>
