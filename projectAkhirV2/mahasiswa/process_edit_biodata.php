<?php
session_start();

// Pastikan mahasiswa sudah login
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'mahasiswa') {
    die("Akses ditolak. Anda harus login terlebih dahulu.");
}

// Ambil data dari form
$nim = $_POST['nim'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$agama = $_POST['agama'];
$alamat = $_POST['alamat'];
$no_telp = $_POST['no_telp'];
$no_telp_wali = $_POST['no_telp_wali'];
$no_telp_ortu = $_POST['no_telp_ortu'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$tgl_lahir = $_POST['tgl_lahir'];
$kota_kelahiran = $_POST['kota_kelahiran'];
$tahun_masuk = $_POST['tahun_masuk'];

// Koneksi database
require_once '../config/connection.php';
$conn = (new connection())->connect();

// Query untuk update data mahasiswa
$query = "UPDATE mahasiswa SET 
            nama_lengkap = :nama, 
            email = :email, 
            agama = :agama, 
            alamat = :alamat, 
            no_telp = :no_telp, 
            no_telp_wali = :no_telp_wali, 
            no_telp_ortu = :no_telp_ortu, 
            jenis_kelamin = :jenis_kelamin, 
            tgl_lahir = :tgl_lahir, 
            kota_kelahiran = :kota_kelahiran, 
            tahun_masuk = :tahun_masuk
          WHERE nim = :nim";

$stmt = $conn->prepare($query);
$stmt->bindParam(':nim', $nim);
$stmt->bindParam(':nama', $nama);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':agama', $agama);
$stmt->bindParam(':alamat', $alamat);
$stmt->bindParam(':no_telp', $no_telp);
$stmt->bindParam(':no_telp_wali', $no_telp_wali);
$stmt->bindParam(':no_telp_ortu', $no_telp_ortu);
$stmt->bindParam(':jenis_kelamin', $jenis_kelamin);
$stmt->bindParam(':tgl_lahir', $tgl_lahir);
$stmt->bindParam(':kota_kelahiran', $kota_kelahiran);
$stmt->bindParam(':tahun_masuk', $tahun_masuk);

if ($stmt->execute()) {
    // Redirect ke halaman profil setelah berhasil update
    header("Location: profil_mahasiswa.php");
    exit();
} else {
    echo "Terjadi kesalahan saat memperbarui data.";
}
?>
