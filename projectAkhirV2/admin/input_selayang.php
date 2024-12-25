<?php
// Memasukkan file koneksi ke database
include('../config/connection.php');

// Memproses form jika ada pengiriman data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $deskripsi = $_POST['selayangpandang'];

    // Validasi input (pastikan tidak kosong)
    if (!empty($deskripsi)) {
        // Buat koneksi ke database
        $conn = new connection();
        $db = $conn->connect();

        try {
            // Query untuk memasukkan data ke tabel selayangpandang
            $sql = "INSERT INTO selayang_pandang (deskripsi) VALUES (:deskripsi)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':deskripsi', $deskripsi, PDO::PARAM_STR);
            
            // Eksekusi query
            $stmt->execute();

            // Pesan sukses setelah data berhasil disimpan
            $successMessage = "Data berhasil disimpan!";
        } catch (PDOException $e) {
            // Pesan error jika terjadi kesalahan
            $errorMessage = "Terjadi kesalahan: " . $e->getMessage();
        }

        // Tutup koneksi
        $conn->disconnect();
    } else {
        $errorMessage = "Deskripsi tidak boleh kosong.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Selayang Pandang</title>
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
        <h1>Selayang Pandang JTI</h1>
        
        <!-- Menampilkan pesan sukses atau error -->
        <?php if (isset($successMessage)): ?>
            <div class="success-message"><?= $successMessage ?></div>
        <?php endif; ?>
        
        <?php if (isset($errorMessage)): ?>
            <div class="error"><?= $errorMessage ?></div>
        <?php endif; ?>

        <form method="POST">
            <label for="selayangpandang">Deskripsi Tentang Jurusan Teknologi Informasi</label>
            <textarea name="selayangpandang" id="selayangpandang"></textarea>

            <button type="submit">Simpan Perubahan</button>
        </form>

        <div class="login-link">
            <p><a href="aturselayang.php">Kembali</a></p>
        </div>
    </div>
</body>
</html>