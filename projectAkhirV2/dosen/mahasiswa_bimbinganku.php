<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peran Dosen Pembimbing</title>
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
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: black;
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

        .message-container {
            margin-bottom: 20px;
        }

        .success-message {
            background-color: #4CAF50; /* Green */
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
        }

        .error-message {
            background-color: #f44336;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
        }
        .navbar {
            text-align: center;
            margin-top: 20px;
            gap: 20px;
        }

        .navbar a {
            text-decoration: none;
            padding: 10px 5px; /* Atur padding agar tombol lebih besar */
            width: 150px; /* Atur lebar tombol secara konsisten */
            display: inline-block; /* Agar width berfungsi */
            text-align: center; /* Teks berada di tengah */
            background-color: #2A6BF8;
            color: white;
            border-radius: 8px; /* Tambahkan sedikit pembulatan */
            font-size: 16px; /* Ukuran teks */
            font-weight: 500; /* Ketebalan teks */
            transition: all 0.3s ease; /* Animasi untuk hover */
            }

        .navbar a:hover {
            background-color: #0056d2; /* Warna saat hover */
            color: #fff; /* Pastikan teks tetap terlihat */
            transform: scale(1.05); /* Sedikit memperbesar tombol saat hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Mahasiswa Bimbinganku</h1>
        <table>
            <thead>
                <tr>
                    <th>ID Dospem</th>
                    <th>Nim</th>
                    <th>Nama</th>
                    <th>Nama Kompetisi</th>
                    <th>Jenis Kompetisi</th>
                    <th>Tingkat Kompetisi</th>
                    <th>Peringkat</th>
                    <th>Tgl Penyelenggaraan</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
        <div class="navbar">
            <a href="lihat_peran.php">Kembali</a>
        </div>
    </div>
</body>
</html>