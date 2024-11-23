<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validasi Prestasi Dosen</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-image: url('img/bg.png');
            background-size: cover;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 60px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group input {
            padding: 10px;
            width: 100%;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .button-group {
            margin-top: 20px;
            text-align: center;
        }

        .button-group button {
            background-color: #6a11cb;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
            font-size: 16px;
        }

        .button-group button:hover {
            background-color: #5a0ca0;
        }

        .biodata {
            display: none;
            background-color: #f0f0f0;
            padding: 20px;
            margin-top: 20px;
            border-radius: 8px;
        }

        .biodata ul {
            list-style-type: none;
            padding: 0;
        }

        .biodata ul li {
            margin: 10px 0;
        }

        /* Styling untuk tombol kembali */
        .back-button {
            background-color: #2575fc;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 100;
            font-size: 16px;
        }

        .back-button:hover {
            background-color: #1f66d2;
        }

    </style>
</head>
<body>

    <!-- Tombol Kembali -->
    <a href="dashboard_dosen.php">
        <button class="back-button">Kembali</button>
    </a>

    <div class="container">
        <div class="header">
            <h2>Validasi Prestasi Mahasiswa</h2>
        </div>

        <!-- Form Pencarian NIM -->
        <div class="form-group">
            <input type="text" id="nim" placeholder="Masukkan NIM Mahasiswa" oninput="searchMahasiswa()" />
        </div>

        <!-- Biodata Mahasiswa yang Ditemukan -->
        <div class="biodata" id="biodata-mahasiswa">
            <h3>Biodata Mahasiswa</h3>
            <ul>
                <li><strong>Nama:</strong> <span id="nama"></span></li>
                <li><strong>NIM:</strong> <span id="nim-mahasiswa"></span></li>
                <li><strong>Program Studi:</strong> <span id="prodi"></span></li>
                <li><strong>Prestasi:</strong> <span id="prestasi"></span></li>
            </ul>

            <!-- Tombol Terima / Tolak Validasi -->
            <div class="button-group">
                <button onclick="terimaValidasi()">Terima Validasi</button>
                <button onclick="tolakValidasi()">Tolak Validasi</button>
            </div>
        </div>
    </div>

    <script>
        // Contoh data mahasiswa (bisa diambil dari database)
        const mahasiswaData = [
            {
                nim: "123456",
                nama: "Budi Santoso",
                prodi: "Teknik Informatika",
                prestasi: "Juara 1 Lomba Koding Nasional"
            },
            {
                nim: "654321",
                nama: "Siti Nurjanah",
                prodi: "Manajemen",
                prestasi: "Pengusaha Muda Terbaik 2024"
            },
            {
                nim: "789012",
                nama: "Rudi Prasetyo",
                prodi: "Teknik Elektro",
                prestasi: "Juara 2 Lomba Desain Robot"
            }
        ];

        // Fungsi untuk mencari mahasiswa berdasarkan NIM
        function searchMahasiswa() {
            const nimInput = document.getElementById("nim").value;
            const biodataSection = document.getElementById("biodata-mahasiswa");
            const nama = document.getElementById("nama");
            const nimMahasiswa = document.getElementById("nim-mahasiswa");
            const prodi = document.getElementById("prodi");
            const prestasi = document.getElementById("prestasi");

            // Cari mahasiswa berdasarkan NIM
            const mahasiswa = mahasiswaData.find(mhs => mhs.nim === nimInput);

            if (mahasiswa) {
                // Jika mahasiswa ditemukan, tampilkan biodata
                nama.textContent = mahasiswa.nama;
                nimMahasiswa.textContent = mahasiswa.nim;
                prodi.textContent = mahasiswa.prodi;
                prestasi.textContent = mahasiswa.prestasi;
                biodataSection.style.display = 'block';
            } else {
                // Jika tidak ditemukan, sembunyikan biodata
                biodataSection.style.display = 'none';
            }
        }

        // Fungsi untuk menangani terima validasi
        function terimaValidasi() {
            const nimInput = document.getElementById("nim").value;
            if (nimInput) {
                alert(`Validasi prestasi mahasiswa dengan NIM ${nimInput} telah diterima.`);
            } else {
                alert("Silakan masukkan NIM terlebih dahulu.");
            }
        }

        // Fungsi untuk menangani tolak validasi
        function tolakValidasi() {
            const nimInput = document.getElementById("nim").value;
            if (nimInput) {
                alert(`Validasi prestasi mahasiswa dengan NIM ${nimInput} telah ditolak.`);
            } else {
                alert("Silakan masukkan NIM terlebih dahulu.");
            }
        }
    </script>

</body>
</html>
