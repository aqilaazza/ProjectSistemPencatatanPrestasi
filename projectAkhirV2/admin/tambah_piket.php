<?php 
// Mengimpor file koneksi
require_once '../config/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengecek apakah data 'nip', 'hari', dan 'jam' tersedia
    if (isset($_POST['nip']) && isset($_POST['hari']) && isset($_POST['jam'])) {
        // Mendapatkan data dari form
        $nip = $_POST['nip'];
        $hari = $_POST['hari'];
        $jam = $_POST['jam'];

        // Mengecek apakah NIP tidak kosong
        if (!empty($nip) && !empty($hari) && !empty($jam)) {
            // Membuat instance koneksi
            $db = new connection();
            $conn = $db->connect();

            try {
                // Menyimpan data ke dalam tabel jadwal_piket
                $sql = "INSERT INTO jadwal_piket (nip, hari, jam) VALUES (:nip, :hari, :jam)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':nip', $nip);
                $stmt->bindParam(':hari', $hari);
                $stmt->bindParam(':jam', $jam);

                if ($stmt->execute()) {
                    echo "<script>alert('Jadwal Piket berhasil disimpan!');</script>";
                } else {
                    echo "<script>alert('Terjadi kesalahan saat menyimpan jadwal piket.');</script>";
                }
            } catch (PDOException $e) {
                // Menangani kesalahan dalam query
                echo "<script>alert('Terjadi kesalahan: " . $e->getMessage() . "');</script>";
            }
        } else {
            echo "<script>alert('Semua field harus diisi!');</script>";
        }
    } else {
        echo "<script>alert('Data tidak lengkap.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jadwal Piket</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        /* Menghilangkan margin dan padding default untuk body dan html */
        html, body {
            height: 100%; /* Pastikan tinggi body dan html 100% */
            margin: 0; /* Hapus margin */
            padding: 0; /* Hapus padding */
            overflow-y: scroll; /* Menambahkan scroll vertikal */
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-image: url('../img/bg.png'); /* Ganti dengan path gambar Anda */
            background-size: cover;
            background-position: center;
            background-attachment: fixed; /* Menjaga background tetap saat digulir */
            display: flex;
            justify-content: center;
            align-items: flex-start; /* Sesuaikan konten di atas */
            height: 100%; /* Pastikan body mengambil seluruh tinggi layar */
            padding: 20px; /* Memberikan sedikit ruang di sekitar body */
            box-sizing: border-box; /* Agar padding tidak mengganggu layout */
        }

        .container {
            background-color: rgba(255, 255, 255, 1); /* Menghapus transparansi pada container */
            border-radius: 25px;
            padding: 20px 40px; /* Menambahkan padding untuk form */
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
            max-width: 500px;
            width: 100%;
            margin-top: 20px; /* Memberikan sedikit ruang di atas container */
            margin-bottom: 20px; /* Memberikan sedikit ruang di bawah container */
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input, select {
            background-color: #eee;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 20px;
            box-sizing: border-box;
            font-size: 14px;
            margin-bottom: 15px;
        }

        select {
            color: #888;
        }

        select option {
            color: #333;
        }

        input[type="file"] {
            padding: 10px;
            background-color: #f1f1f1;
        }

        input[type="file"]:before {
            content: "Pilih file"; /* Placeholder text for file input */
            color: #888;
            font-size: 14px;
            display: block;
            padding: 10px;
            border: 1px dashed #ccc;
            border-radius: 5px;
            text-align: center;
        }

        input[type="file"]:hover::before {
            content: "Unggah Dokumentasi (Klik untuk memilih)";
        }

        input[type="date"] {
            background-color: #eee;
            color: #888;
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
            margin-top: 20px;
            align-self: center;
        }

        button:hover {
            background-image: linear-gradient(to right, #5a0e9d, #1e5bc0);
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
        <h2>Input Jadwal Piket</h2>
        <form action="#" method="POST" enctype="multipart/form-data">
            <label for="nip">NIP</label>
            <input type="text" name="nip" placeholder="ex: 197811222009121017" required />
            <label for="hari">Hari</label>
            <input type="text" name="hari" placeholder="ex: Senin - Selasa" required />
            <label for="jam">Jam</label>
            <input type="text" name="jam" placeholder="ex: 07:00 - 16:00" required />
            <button type="submit">Simpan</button>
        </form>
        <div class="login-link">
            <p><a href="../dashboard/dashboardAdmin.php">Kembali</a></p>
        </div>
    </div>
</body>
</html>