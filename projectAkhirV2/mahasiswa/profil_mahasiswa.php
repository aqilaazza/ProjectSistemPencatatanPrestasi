<?php
session_start();

// Pastikan mahasiswa sudah login
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'mahasiswa') {
    die("Akses ditolak. Anda harus login terlebih dahulu.");
}

// Ambil data mahasiswa dari session
$nim = $_SESSION['nim'];
$nama = $_SESSION['nama'];
// Lakukan query untuk mengambil data mahasiswa berdasarkan NIM jika perlu
// Misalnya mengambil data dari database berdasarkan NIM

// Koneksi database dan ambil data mahasiswa berdasarkan NIM
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
    <title>Profil Mahasiswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        /* Reset CSS */
html, body {
    height: 100%;
    margin: 0;
    padding: 0;
    overflow-y: scroll;
    font-family: 'Poppins', sans-serif;
}

/* Background dan Layout */
body {
    background-image: url('../img/bg.png');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    padding: 20px;
    box-sizing: border-box;
}

.container {
    background-color: rgba(255, 255, 255, 0.9);
    border-radius: 25px;
    padding: 30px 40px;
    box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
    max-width: 500px;
    width: 100%;
    text-align: center;
    margin-top: 20px;
    margin-bottom: 20px;
    border: 1px solid #ddd;
}

h2 {
    margin-bottom: 20px;
    font-size: 24px;
    font-weight: 600;
    color: #333;
}

/* Form Styling */
form {
    display: flex;
    flex-direction: column;
    align-items: center;
}

input, select {
    background-color: #eee;
    border: 1px solid #ccc;
    padding: 12px;
    width: 100%;
    border-radius: 20px;
    box-sizing: border-box;
    font-size: 14px;
    color: #333;
}

input[readonly], select[disabled] {
    background-color: #f5f5f5;
    color: #8a8a8a;
    cursor: not-allowed;
}

button {
    border-radius: 20px;
    border: none;
    background-image: linear-gradient(to right, #6a11cb, #2575fc);
    color: #fff;
    padding: 12px 45px;
    font-size: 14px;
    cursor: pointer;
    transition: transform 80ms ease-in;
    margin-top: 20px;
}

button:hover {
    background-image: linear-gradient(to right, #5a0e9d, #1e5bc0);
    transform: translateY(-3px);
}

button:active {
    transform: translateY(1px);
}

/* Login Link */
.login-link {
    margin-top: 20px;
}

.login-link a {
    color: #FF416C;
    text-decoration: none;
    font-weight: 500;
}

.login-link a:hover {
    text-decoration: underline;
}

/* Responsiveness */
@media (max-width: 600px) {
    .container {
        padding: 20px;
        max-width: 100%;
    }

    input, select, button {
        width: 100%;
        font-size: 14px;
    }
}

    </style>
</head>
<body>
    <div class="container">
        <h2>Profil Mahasiswa</h2>
        <form action="#" method="post">
            <p>NIM</p>
            <input type="text" name="nim" placeholder="NIM" value="<?php echo htmlspecialchars($mahasiswa['nim']); ?>" readonly />
            <p>Nama Lengkap</p>
            <input type="text" name="nama" placeholder="Nama Lengkap" value="<?php echo htmlspecialchars($mahasiswa['nama_lengkap']); ?>" readonly />
            <p>Email/Gmail</p>
            <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($mahasiswa['email']); ?>" readonly />
            <p>Agama</p>
            <select name="agama" disabled>
                <option value="Islam" <?php echo $mahasiswa['agama'] == 'Islam' ? 'selected' : ''; ?>>Islam</option>
                <option value="Kristen Protestan" <?php echo $mahasiswa['agama'] == 'Kristen Protestan' ? 'selected' : ''; ?>>Kristen Protestan</option>
                <option value="Kristen Katolik" <?php echo $mahasiswa['agama'] == 'Kristen Katolik' ? 'selected' : ''; ?>>Kristen Katolik</option>
                <option value="Hindu" <?php echo $mahasiswa['agama'] == 'Hindu' ? 'selected' : ''; ?>>Hindu</option>
                <option value="Buddha" <?php echo $mahasiswa['agama'] == 'Buddha' ? 'selected' : ''; ?>>Buddha</option>
                <option value="Konghucu" <?php echo $mahasiswa['agama'] == 'Konghucu' ? 'selected' : ''; ?>>Konghucu</option>
                <option value="Lainnya" <?php echo $mahasiswa['agama'] == 'Lainnya' ? 'selected' : ''; ?>>Lainnya</option>
            </select>
            <p>Alamat</p>
            <input type="text" name="alamat" placeholder="Alamat" value="<?php echo htmlspecialchars($mahasiswa['alamat']); ?>" readonly />
            <p>Nomor Telepon</p>
            <input type="text" name="no_telp" placeholder="No. Telp" value="<?php echo htmlspecialchars($mahasiswa['no_telp']); ?>" readonly />
            <p>Nomor Telepon Wali</p>
            <input type="text" name="no_telp_wali" placeholder="No. Telp Wali" value="<?php echo htmlspecialchars($mahasiswa['no_telp_wali']); ?>" readonly />
            <p>Nomor Telepon Orang Tua</p>
            <input type="text" name="no_telp_ortu" placeholder="No. Telp Orang Tua" value="<?php echo htmlspecialchars($mahasiswa['no_telp_ortu']); ?>" readonly />
            <p>Jenis Kelamin</p>
            <input type="text" name="jenis kelamin" placeholder="Jenis Kelamin" value="<?php echo htmlspecialchars($mahasiswa['jenis_kelamin']); ?>" readonly />
            <p>Tanggal Lahir</p>
            <input type="text" name="jenis kelamin" placeholder="Jenis Kelamin" value="<?php echo htmlspecialchars($mahasiswa['tgl_lahir']); ?>" readonly />
            <p>Kota Kelahiran</p>
            <input type="text" name="jenis kelamin" placeholder="Jenis Kelamin" value="<?php echo htmlspecialchars($mahasiswa['kota_kelahiran']); ?>" readonly />
            <p>Tahun Masuk</p>
            <input type="text" name="jenis kelamin" placeholder="Jenis Kelamin" value="<?php echo htmlspecialchars($mahasiswa['tahun_masuk']); ?>" readonly />
            
            <button type="button" id="editButton" onclick="window.location.href='biodata_mahasiswa.php'">Edit</button>

        </form>
        <div class="login-link">
            <p><a href="../dashboard/dashboardMahasiswa.php">Kembali</a></p>
        </div>
    </div>
</body>
</html>
