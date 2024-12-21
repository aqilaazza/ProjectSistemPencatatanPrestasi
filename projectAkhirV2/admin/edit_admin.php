<?php
include('../config/connection.php');
include('../models/user.php');
include('../models/admin.php');

// Memanggil objek dari kelas connection untuk mendapatkan koneksi PDO
$conn = new connection();
$pdo = $conn->connect();

// Periksa apakah NIP ada di URL
if (!isset($_GET['nip'])) {
    die("NIP tidak ditemukan.");
}

$nip = $_GET['nip'];
$admin = new Admin($pdo);

// Mengambil data admin berdasarkan NIP
try {
    $sql = "SELECT * FROM admin WHERE nip = :nip";
    $query = $pdo->prepare($sql);
    $query->bindParam(':nip', $nip);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_ASSOC);

    if (!$data) {
        die("Data admin tidak ditemukan.");
    }
} catch (PDOException $e) {
    die("Kesalahan: " . $e->getMessage());
}

// Memproses data yang dikirim melalui formulir
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $no_telp = $_POST['no_telp'];
    $alamat = $_POST['alamat'];

    // Memperbarui data admin
    try {
        $updateData = [
            'nama' => $nama,
            'email' => $email,
            'no_telp' => $no_telp,
            'alamat' => $alamat
        ];
        $result = $admin->update($nip, $updateData);

        if ($result) {
            header("Location: biodata_admin.php?status=success");
            exit();
        } else {
            $error = "Gagal memperbarui data admin.";
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
    <title>Edit Admin</title>
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
            max-width: 600px;
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

        textarea {
            resize: none;
            height: 80px;
        }

        button {
            background-color: #2A6BF8;
            color: white;
            cursor: pointer;
            font-weight: bold;
            background-image: linear-gradient(to right, #6a11cb, #2575fc);
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
        .login-link {
            margin-top: 20px;
            text-align:center;
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
        <h1>Edit Data Admin</h1>
        
        <!-- Menampilkan pesan error jika ada -->
        <?php if (isset($error)) : ?>
            <p class="error"><?= htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form method="POST">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" value="<?= htmlspecialchars($data['nama']); ?>" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?= htmlspecialchars($data['email']); ?>" required>

            <label for="no_telp">No Telepon</label>
            <input type="text" name="no_telp" id="no_telp" value="<?= htmlspecialchars($data['no_telp']); ?>" required>

            <label for="alamat">Alamat</label>
            <textarea name="alamat" id="alamat" required><?= htmlspecialchars($data['alamat']); ?></textarea>

            <button type="submit">Simpan Perubahan</button>
        </form>

        <div class="login-link">
            <p><a href="biodata_admin.php">Kembali</a></p>
        </div>
    </div>
</body>
</html>
