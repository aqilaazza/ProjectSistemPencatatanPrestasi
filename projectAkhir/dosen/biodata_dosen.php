<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata Dosen</title>
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
            background-image: url('img/bg.png'); /* Ganti dengan path gambar Anda */
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
            background-color: rgba(255, 255, 255, 1);
            border-radius: 25px;
            padding: 20px 40px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
            max-width: 400px;
            width: 100%;
            text-align: center;
            margin-top: 20px; /* Memberikan sedikit ruang di atas container */
            margin-bottom: 20px; /* Memberikan sedikit ruang di bawah container */
        }

        h2 {
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
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

        .warning-container {
            border: 2px solid rgba(255, 0, 0, 0.5); /* Border merah transparan */
            border-radius: 1px;
            padding: 0px;
            margin-bottom: 20px;
            width: 100%;
            text-align: center;
        }

        .warning {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Biodata Dosen</h2>
        <div class="warning-container">
            <p class="warning">Anda harus melengkapi biodata sebelum lanjut ke laman Dashboard</p>
        </div>
        <form action="#">
            <input type="text" placeholder="Nama" required />
            <input type="text" placeholder="Alamat" required />
            <input type="tel" placeholder="Nomor Telepon" required />
            <input type="text" placeholder="Kota Kelahiran" required />
            <select required>
                <option value="" disabled selected hidden>Agama</option>
                <option value="Islam">Islam</option>
                <option value="Kristen">Kristen</option>
                <option value="Hindu">Hindu</option>
                <option value="Buddha">Buddha</option>
                <option value="Konghucu">Konghucu</option>
            </select>
            <input type="text" placeholder="Jabatan" required />
            <input type="text" placeholder="Program Studi" required />
            <input type="text" placeholder="Mata Kuliah Utama" required />
            <input type="email" placeholder="Email" required />
            <button type="submit">Simpan</button>
        </form>
        <div class="login-link">
            <p><a href="login.php">Kembali ke Login</a></p>
        </div>
    </div>
</body>
</html>
