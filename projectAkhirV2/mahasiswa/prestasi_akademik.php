<?php
// Mulai sesi
session_start();

// Periksa apakah pengguna adalah mahasiswa yang telah login
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'mahasiswa') {
    header("Location: ../login.php?message=unauthorized");
    exit();
}

// Ambil NIM dari sesi login
$nim = $_SESSION['nim'];

// Impor koneksi database
require_once '../config/connection.php';

// Ambil data IP berdasarkan NIM dari database
$conn = (new connection())->connect();
$query = "SELECT semester, ip FROM prestasi_akademik WHERE nim = :nim ORDER BY semester";
$stmt = $conn->prepare($query);
$stmt->bindParam(":nim", $nim);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Format data IP per semester
$ip_data = [];
foreach ($results as $row) {
    $ip_data[$row['semester']] = $row['ip'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IP Mahasiswa</title>
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
        }

        input[readonly] {
            background-color: #f9f9f9;
            color: #666;
            cursor: not-allowed;
        }

        .back-button {
            text-align: center;
            margin-top: 20px;
        }

        .back-button a {
            color: #FF416C;
            font-size: 16px;
        }

        .back-button a:hover {
            color: #FF416C;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>IP Saya</h1>
        <form>
            <?php for ($i = 1; $i <= 8; $i++): ?>
                <label for="semester<?= $i ?>">Semester <?= $i ?>:</label>
                <input
                    type="number"
                    id="semester<?= $i ?>"
                    name="semester[<?= $i ?>]"
                    step="0.01"
                    value="<?= isset($ip_data[$i]) ? htmlspecialchars($ip_data[$i]) : '' ?>"
                    readonly
                >
            <?php endfor; ?>
        </form>
        <div class="back-button">
            <a href="../dashboard/dashboardMahasiswa.php">Kembali</a>
        </div>
    </div>
</body>
</html>