<?php
// Mengimpor koneksi database dari connection.php
require_once 'config/connection.php';

// Ambil parameter role dan data form
$role = $_GET['role'] ?? ''; // role dari URL parameter
$username = trim($_POST['username'] ?? '');  // Pangkas spasi pada username
$password = trim($_POST['password'] ?? '');  // Pangkas spasi pada password

// Validasi input
if (!$role || !$username || !$password) {
    die("Permintaan tidak valid.");
}

// Tentukan tabel dan kolom berdasarkan role
$table = '';
$column = '';
switch ($role) {
    case 'mahasiswa':
        $table = 'login_mahasiswa';
        $column = 'nim';  // Mahasiswa menggunakan kolom 'nim' untuk username
        break;
    case 'admin':
        $table = 'login_admin';
        $column = 'nip';  // Admin menggunakan kolom 'nip' untuk username
        break;
    case 'dosen':
        $table = 'login_dosen';
        $column = 'nidn'; // Dosen menggunakan kolom 'nidn' untuk username
        break;
    default:
        die("Role tidak valid.");
}

// Query cek login berdasarkan role dan username
$conn = (new connection())->connect();
$query = "SELECT * FROM $table WHERE $column = :username;";
$stmt = $conn->prepare($query);
$stmt->bindParam(":username", $username);
$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);  // Menggunakan fetch untuk mengambil satu baris data

// Debugging: Cek hasil query
if (!$result) {
    header("Location: login.php?message=invalid_credentials");
    return;
}

// Hilangkan spasi tambahan pada password dari database
$dbPassword = trim($result["password"]);

// Verifikasi password (baik hash atau plaintext)
if ($dbPassword === $password || password_verify($password, $dbPassword)) {
    // Login sukses, simpan data dalam session berdasarkan role
    session_start();
    $_SESSION['role'] = $role;
    $_SESSION['username'] = $username;

    // Simpan data yang relevan berdasarkan role
    switch ($role) {
        case 'mahasiswa':
            $_SESSION['nama'] = $result['nama'];  // Simpan nama mahasiswa
            $_SESSION['nim'] = $username;         // Simpan NIM mahasiswa
            break;
        case 'admin':
            $_SESSION['nama'] = $result['nama'];  // Simpan nama admin
            $_SESSION['nip'] = $username;         // Simpan NIP admin
            break;
        case 'dosen':
            $_SESSION['nama'] = $result['nama'];  // Simpan nama dosen
            $_SESSION['nidn'] = $username;        // Simpan NIDN dosen
            break;
    }

    // Redirect sesuai role
    switch ($role) {
        case 'mahasiswa':
            header("Location: ./dashboard/dashboardMahasiswa.php");
            exit();
        case 'admin':
            header("Location: ./dashboard/dashboardAdmin.php");
            exit();
        case 'dosen':
            header("Location: ./dashboard/dashboardDosen.php");
            exit();
        default:
            echo "Role tidak valid";
            return;
    }
} else {
    header("Location: login.php?message=invalid_credentials");  // Redirect ke halaman login dengan pesan kesalahan
    return;
}
?>
