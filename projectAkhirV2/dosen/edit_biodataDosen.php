<?php
session_start();

// Pastikan dosen sudah login
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'dosen') {
    die("Akses ditolak. Anda harus login terlebih dahulu.");
}

// Ambil data dari session dan form
$nidn = $_SESSION['nidn']; // Ambil NIDN dari session
$nama = $_POST['nama_lengkap'];
$email = $_POST['email'];
$agama = $_POST['agama'];
$alamat = $_POST['alamat'];
$no_telp = $_POST['no_telp'];
$jabatan = $_POST['jabatan'];
$tgl_lahir = $_POST['tgl_lahir'];
$kota_kelahiran = $_POST['kota_kelahiran'];

// Koneksi database
require_once '../config/connection.php';
$conn = (new connection())->connect();

// Query untuk update data dosen
$query = "UPDATE dosen SET 
            nama = :nama, 
            email = :email, 
            agama = :agama, 
            alamat = :alamat, 
            no_telp = :no_telp, 
            jabatan = :jabatan, 
            tgl_lahir = :tgl_lahir, 
            kota_kelahiran = :kota_kelahiran
          WHERE nidn = :nidn";

$stmt = $conn->prepare($query);
$stmt->bindParam(':nidn', $nidn);
$stmt->bindParam(':nama', $nama);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':agama', $agama);
$stmt->bindParam(':alamat', $alamat);
$stmt->bindParam(':no_telp', $no_telp);
$stmt->bindParam(':jabatan', $jabatan);
$stmt->bindParam(':tgl_lahir', $tgl_lahir);
$stmt->bindParam(':kota_kelahiran', $kota_kelahiran);

if ($stmt->execute()) {
    header("Location: biodata_dosen.php");
    exit();
} else {
    echo "Terjadi kesalahan saat memperbarui data.";
}
?>
