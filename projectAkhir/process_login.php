<?php
// Mengimpor koneksi database dari connection.php
require_once 'config/connection.php';

// Ambil parameter role dan data form
$role = $_GET['role'] ?? '';
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

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
$conn = connection();
$query = "SELECT * FROM $table WHERE $column = :username;";
$stmt = $conn->prepare($query);
$stmt->bindParam(":username", $username);
$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);



if (!$result) {
    echo "nim salah";
    return;
}

foreach ($result as $res) {


    if ($res["password"] !== $password) {
        echo "password salah";
        return;
    }
    
    echo "sukses";
}

// if (!$result) {
//     echo "salah bro";
//     return;
// }



// // Jika username ditemukan
// if ($result->num_rows > 0) {
//     $row = $result->fetch_assoc();
//     // Verifikasi password
//     if (password_verify($password, $row['password'])) {
//         // Redirect ke dashboard sesuai role
//         switch ($role) {
//             case 'mahasiswa':
//                 header("Location: dashboard_mahasiswa.php");
//                 break;
//             case 'admin':
//                 header("Location: dashboard_admin.php");
//                 break;
//             case 'dosen':
//                 header("Location: dashboard_dosen.php");
//                 break;
//         }
//         exit();  // Pastikan program berhenti setelah melakukan redirect
//     } else {
//         echo "<script>alert('Password salah.'); window.history.back();</script>";
//     }
// } else {
//     echo "<script>alert('Username tidak ditemukan.'); window.history.back();</script>";
// }

// // Menutup statement dan koneksi
// $stmt->close();
// $conn->close();
