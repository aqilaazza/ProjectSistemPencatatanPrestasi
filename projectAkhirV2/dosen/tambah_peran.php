<?php
// Sertakan file koneksi dan model dosen
include('../config/connection.php');
include('../models/user.php');
include('../models/dosen.php');

// Membuat instance dari kelas connection
$db = new connection();
$pdo = $db->connect();

$dosen = new Dosen($pdo);

// Proses ketika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data1 = [
        'nidn' => $_POST['nidn'],
        'peran' => $_POST['peran'],
    ];

    try {
        // Menambahkan data ke tabel dosen_pembimbing
        $dosen->addPeran($data1);

        // Redirect ke halaman lihat_peran.php setelah berhasil
        header("Location: lihat_peran.php");
        exit();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        /* Menghilangkan margin dan padding default untuk body dan html */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-image: url('../img/bg.png');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: rgba(255, 255, 255, 1);
            border-radius: 25px;
            padding: 40px 40px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
            max-width: 400px;
            width: 100%;
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        h2 {
            margin-bottom: 20px;
        }

        input {
            background-color: #eee;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 20px;
            box-sizing: border-box;
            font-size: 14px;
            margin-bottom: 15px;
        }

        button {
            border-radius: 20px;
            border: none;
            background-image: linear-gradient(to right, #6a11cb, #2575fc);
            color: #fff;
            padding: 12px 45px;
            font-size: 12px;
            cursor: pointer;
            transition: transform 80ms ease-in;
        }

        button:hover {
            background-image: linear-gradient(to right, #5a0e9d, #1e5bc0);
        }


        .login-link {
            margin-top: 20px;
        }

        .login-link a {
            color: #FF416C;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Inputkan Peran Anda Sebagai Dosen Pembimbing</h2>
        <!-- Form untuk menambah data peran dospem -->
        <form action="" method="POST">
            <input type="text" name="nidn" placeholder="NIDN" required />
            <input type="text" name="peran" placeholder="Peran" required />
            <button type="submit">Simpan</button>
        </form>
        <div class="login-link">
            <p><a href="lihat_peran.php">Batal</a></p>
        </div>
    </div>
</body>
</html>