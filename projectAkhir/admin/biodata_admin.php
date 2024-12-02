<?php
// Mengimpor koneksi database dari connection.php
include('../config/connection.php');

try {
    // Memanggil fungsi connection() untuk mendapatkan koneksi PDO
    $pdo = connection();

    // Query untuk mengambil semua biodata admin
    $sql = "SELECT * FROM admin";
    $query = $pdo->prepare($sql);  // Menggunakan objek PDO dari connection.php
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Query gagal: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7fa;
            color: #333;
            padding: 40px 10px;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color : black;
        }

        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
            background-color: #fff;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: blue;
            color: white;
            font-weight: 600;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .action-buttons {
            display: flex;
            justify-content: space-evenly;
            gap: 10px;
        }

        .action-buttons form {
            display: inline-block;
        }

        .action-buttons button {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            font-size: 14px;
            font-weight: 500;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            outline: none;
        }

        .action-buttons .edit-button {
            background-color: #4CAF50; /* Green */
            color: white;
        }

        .action-buttons .edit-button i {
            color: #ffffff;
        }

        .action-buttons .edit-button:hover {
            background-color: #45a049;
            transform: scale(1.05);
        }

        .action-buttons .delete-button {
            background-color: #f44336; /* Red */
            color: white;
        }

        .action-buttons .delete-button i {
            color: #ffffff;
        }

        .action-buttons .delete-button:hover {
            background-color: #e53935;
            transform: scale(1.05);
        }

        .button-container {
            text-align: center;
            margin-top: 30px;
        }

        .button-container a {
            text-decoration: none;
            margin: 5px;
        }

        .button-container button {
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            background-color: #2A6BF8;
            color: white;
        }

        .button-container button:hover {
            background-color: #1a4db4;
        }

        @media (max-width: 768px) {
            table {
                font-size: 14px;
            }

            button {
                width: 100%;
                padding: 12px;
                font-size: 14px;
            }

            .action-buttons {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Biodata Admin</h1>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($results as $row) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["nip"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["nama"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["no_telp"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["alamat"]) . "</td>";
                    echo "<td class='action-buttons'>";
                    echo "<form action='edit_admin.php' method='get'>";
                    echo "<input type='hidden' name='nip' value='" . htmlspecialchars($row['nip']) . "'>";
                    echo "<button type='submit' class='edit-button'><i class='fas fa-edit'></i> Edit</button>";
                    echo "</form>";
                    echo "<form action='hapus_admin.php' method='get' onsubmit='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");'>";
                    echo "<input type='hidden' name='nip' value='" . htmlspecialchars($row['nip']) . "'>";
                    echo "<button type='submit' class='delete-button'><i class='fas fa-trash'></i> Hapus</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="button-container">
            <a href="tambah_admin.php" class="btn btn-primary">
                <i class="fa fa-plus-circle"></i> Tambah Data
            </a>
            <a href="dashboard_admin.php" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</body>
</html>
