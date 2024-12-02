<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Prestasi Non-Akademik</title>
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
        <h2>Data Prestasi Non-Akademik</h2>
        <form action="#">
            <input type="text" placeholder="Nama Kompetisi" required />
            <input type="text" placeholder="Jenis Kompetisi" required />
            <input type="text" placeholder="Tingkat Kompetisi" required />
            <input type="date" placeholder="Tanggal Penyelenggaraan" required />
            <label for="upload-dokumentasi">Upload Dokumentasi</label>
            <input type="file" id="upload-dokumentasi" required />
            <label for="upload-sertifikat">Upload Sertifikat</label>
            <input type="file" id="upload-sertifikat" required />
            <label for="upload-karya">Upload Karya</label>
            <input type="file" id="upload-karya" required />
            <label for="upload-surat-tugas">Upload Surat Tugas</label>
            <input type="file" id="upload-surat-tugas" required />
            <input type="text" placeholder="Penyelenggara" required />
            <input type="text" placeholder="Peringkat" required />

            <button type="submit">Simpan</button>
        </form>
        <div class="login-link">
            <p><a href="dashboard_mahasiswa.php">Kembali ke Dashboard</a></p>
        </div>
    </div>
</body>
</html>
