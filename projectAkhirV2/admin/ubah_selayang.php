<?php
// Masukkan kode untuk koneksi database (gunakan file connection.php yang sudah Anda buat sebelumnya)
require_once '../config/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil nilai dari form
    $deskripsi = $_POST['selayangpandang'];

    // Validasi jika deskripsi tidak kosong
    if (!empty($deskripsi)) {
        try {
            // Membuat koneksi ke database
            $connection = new connection();
            $db = $connection->connect();

            // Query untuk memperbarui deskripsi dengan id_selayang = 1
            $sql = "UPDATE selayang_pandang SET deskripsi = :deskripsi WHERE id_selayang = 1";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':deskripsi', $deskripsi, PDO::PARAM_STR);

            // Eksekusi query
            $stmt->execute();

            // Pesan sukses
            $message = "Perubahan berhasil disimpan!";
        } catch (PDOException $e) {
            $error = "Terjadi kesalahan: " . $e->getMessage();
        }
    } else {
        $error = "Deskripsi tidak boleh kosong!";
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
        /* Tambahkan styling CSS Anda di sini */
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
            text-align: center;
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

        <?php if (isset($message)): ?>
            <div class="success-message">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="error">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <label for="selayangpandang">Deskripsi Tentang Jurusan Teknologi Informasi</label>
            <textarea name="selayangpandang" id="selayangpandang"><?php echo isset($deskripsi) ? $deskripsi : ''; ?></textarea>

            <button type="submit">Simpan Perubahan</button>
        </form>

        <div class="login-link">
            <p><a href="aturselayang.php">Kembali</a></p>
        </div>
    </div>
</body>
</html>