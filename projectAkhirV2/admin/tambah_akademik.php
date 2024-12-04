<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Prestasi Akademik</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Menghilangkan margin dan padding default untuk body dan html */
        html, body {
            height: 100%; /* Pastikan tinggi body dan html 100% */
            margin: 0; /* Hapus margin */
            padding: 0; /* Hapus padding */
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-image: url('../img/bg.png');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: rgba(255, 255, 255, 1); /* Menghapus transparansi pada container */
            border-radius: 25px;
            padding: 40px 60px; /* Memberikan padding di dalam container */
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
            max-width: 400px;
            width: 100%;
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 1px;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            font-size: 14px;
        }

        input[type="text"], input[type="number"], select {
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
        }

        button:hover {
            background-image: linear-gradient(to right, #5a0e9d, #1e5bc0);
        }

        .back-link {
            color: #FF416C;
            text-decoration: none;
            font-size: 14px;
            margin-top: 10px;
            display: block;
            text-align: center;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .warning {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Form Unggah Prestasi Akademik</h1>

        <!-- Pesan Peringatan jika data belum lengkap -->
        <form id="academicForm">
            <div class="form-group">
                <label for="nim">NIM:</label>
                <input type="text" id="nim" name="nim" required>
            </div>

            <div class="form-group">
                <label for="nama">Nama Lengkap:</label>
                <input type="text" id="nama" name="nama" readonly>
            </div>

            <div class="form-group">
                <label for="semester">Semester:</label>
                <select id="semester" name="semester" required>
                    <option value="">Pilih Semester</option>
                    <option value="1">Semester 1</option>
                    <option value="2">Semester 2</option>
                    <option value="3">Semester 3</option>
                    <option value="4">Semester 4</option>
                    <option value="5">Semester 5</option>
                    <option value="6">Semester 6</option>
                    <option value="7">Semester 7</option>
                    <option value="8">Semester 8</option>
                </select>
            </div>

            <div class="form-group">
                <label for="ip">IP:</label>
                <input type="number" id="ip" name="ip" step="0.01" min="0" max="4" required>
            </div>

            <button type="submit">Simpan Data</button>
        </form>

        <!-- Link Kembali ke Dashboard -->
        <a href="prestasi_akademik.php" class="back-link">Batal</a>
    </div>

    <script>
        // Fungsi untuk mengambil nama mahasiswa berdasarkan NIM
        document.getElementById('nim').addEventListener('input', function() {
            var nim = this.value;

            // Cek apakah NIM sudah ada, jika ada, ambil nama mahasiswa
            if (nim.length === 10) { // Asumsi panjang NIM adalah 10 karakter
                fetch('get_nama_mahasiswa.php?nim=' + nim)
                    .then(response => response.json())
                    .then(data => {
                        if (data.nama) {
                            document.getElementById('nama').value = data.nama;
                        } else {
                            alert('Nama mahasiswa tidak ditemukan!');
                            document.getElementById('nama').value = '';
                        }
                    })
                    .catch(error => {
                        alert('Terjadi kesalahan: ' + error);
                    });
            } else {
                document.getElementById('nama').value = '';
            }
        });

        // Fungsi untuk menangani form submit
        document.getElementById('academicForm').onsubmit = function(e) {
            e.preventDefault();

            // Ambil data form
            var nim = document.getElementById('nim').value;
            var nama = document.getElementById('nama').value;
            var semester = document.getElementById('semester').value;
            var ip = document.getElementById('ip').value;

            if (nim && nama && semester && ip) {
                // Kirim data ke server atau simpan dalam database
                alert('Data berhasil disimpan!');
                window.location.href = 'dashboard_mahasiswa.php'; // Kembali ke dashboard
            } else {
                alert('Mohon lengkapi semua data!');
            }
        };
    </script>
</body>
</html>
