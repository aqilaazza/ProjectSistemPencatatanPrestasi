<?php
// Koneksi ke database
include('../config/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data yang dikirimkan dari form
    $nim = $_POST['nim'];

    // Koneksi database
    $dbConnection = new connection();
    $pdo = $dbConnection->connect();

    // Perbarui IP per semester
    for ($i = 1; $i <= 8; $i++) {
        if (!empty($_POST["semester$i"])) {
            $ip = $_POST["semester$i"];
            // Query untuk memperbarui IP per semester
            $query = "UPDATE prestasi_akademik SET ip = :ip WHERE nim = :nim AND semester = :semester";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':ip', $ip);
            $stmt->bindParam(':nim', $nim);
            $stmt->bindParam(':semester', $i);
            $stmt->execute();
        }
    }

    // Redirect atau tampilkan pesan sukses
    header('Location: ipMhs.php'); // Ganti dengan halaman yang sesuai
    exit;
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah IP Mahasiswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-image: url('../img/bg.png');
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: 500;
            color: #333;
        }

        input[type="text"], input[type="number"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            background-color: #f9f9f9;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .back-button {
            margin-top: 20px;
            text-align: center;
        }

        .back-button a {
            text-decoration: none;
            color: white;
            background-color: #6c757d;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .back-button a:hover {
            background-color: #5a6268;
            text-align: center;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .button-container button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
        }

        .button-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Ubah IP Mahasiswa</h1>
        <form action="" method="post">
            <?php
            // Dapatkan NIM dari parameter GET
            $nim = isset($_GET['nim']) ? $_GET['nim'] : '';

            if ($nim) {
                $dbConnection = new connection();
                $pdo = $dbConnection->connect();

                // Query untuk mendapatkan data IP per semester berdasarkan NIM
                $query = "SELECT semester, ip FROM prestasi_akademik WHERE nim = :nim ORDER BY semester";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':nim', $nim);
                $stmt->execute();

                $ipData = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Array untuk menyimpan IP per semester
                $semesterIP = array_fill(1, 8, '');

                // Isi array berdasarkan data dari database
                foreach ($ipData as $row) {
                    $semesterIP[(int)$row['semester']] = $row['ip'];
                }

                // Tampilkan input untuk setiap semester
                for ($i = 1; $i <= 8; $i++) {
                    echo "<label for='semester$i'>Semester $i:</label>";
                    if ($semesterIP[$i] !== '') {
                        echo "<input type='number' id='semester$i' name='semester$i' step='0.01' value='" . htmlspecialchars($semesterIP[$i]) . "'>";
                    } else {
                        echo "<input type='number' id='semester$i' name='semester$i' step='0.01' value='' disabled>";
                    }
                }

                // Tambahkan field nim tersembunyi untuk digunakan saat simpan
                echo "<input type='hidden' name='nim' value='" . htmlspecialchars($nim) . "'>";
            } else {
                echo "<p>NIM tidak ditemukan.</p>";
            }
            ?>
            <div class="button-container">
                <button type="submit">Simpan</button>
            </div>
        </form>
        <div class="button-container">
            <form action="ipMhs.php" method="get" style="display:inline;">
                <button type="submit">Kembali</button>
            </form>
        </div>
    </div>
</body>
</html>