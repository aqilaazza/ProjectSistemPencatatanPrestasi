<?php
// Menyertakan file koneksi ke database
include('../config/connection.php');
// Menangani penyimpanan data setelah form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nama_kompetisi = $_POST['nama-kompetisi'];
    $id_dosen_pembimbing = $_POST['id-dosen-pembimbing'];
    $nim_mahasiswa = $_POST['nim-mahasiswa'];
    $peran = $_POST['peran'];
    $jenis_kompetisi = $_POST['jenis-kompetisi'];
    $tingkat_kompetisi = $_POST['tingkat-kompetisi'];
    $tanggal_penyelenggaraan = $_POST['tanggal-penyelenggaraan'];
    $penyelenggara = $_POST['penyelenggara'];
    $peringkat = $_POST['peringkat'];

    // Validasi peringkat
    $validPeringkat = ['Lainnya', 'Harapan 3', 'Harapan 2', 'Harapan 1', 'Juara 3', 'Juara 2', 'Juara 1'];
    if (!in_array($peringkat, $validPeringkat)) {
        echo "<p>Peringkat yang Anda pilih tidak valid!</p>";
        exit;
    }

    // Pastikan tanggal tidak kosong
    if (empty($tanggal_penyelenggaraan)) {
        echo "<p>Anda harus mengisi tanggal penyelenggaraan!</p>";
    } else {
        // Menangani upload file
        $foto_kegiatan = null;
        $sertifikat = null;
        $karya = null;
        $surat_tugas = null;

        if (isset($_FILES['upload-dokumentasi']) && $_FILES['upload-dokumentasi']['error'] == 0) {
            $foto_kegiatan = 'uploads/' . basename($_FILES['upload-dokumentasi']['name']);
            move_uploaded_file($_FILES['upload-dokumentasi']['tmp_name'], $foto_kegiatan);
        }
        if (isset($_FILES['upload-sertifikat']) && $_FILES['upload-sertifikat']['error'] == 0) {
            $sertifikat = 'uploads/' . basename($_FILES['upload-sertifikat']['name']);
            move_uploaded_file($_FILES['upload-sertifikat']['tmp_name'], $sertifikat);
        }
        if (isset($_FILES['upload-karya']) && $_FILES['upload-karya']['error'] == 0) {
            $karya = 'uploads/' . basename($_FILES['upload-karya']['name']);
            move_uploaded_file($_FILES['upload-karya']['tmp_name'], $karya);
        }
        if (isset($_FILES['upload-surat-tugas']) && $_FILES['upload-surat-tugas']['error'] == 0) {
            $surat_tugas = 'uploads/' . basename($_FILES['upload-surat-tugas']['name']);
            move_uploaded_file($_FILES['upload-surat-tugas']['tmp_name'], $surat_tugas);
        }

        // Menyimpan data ke dalam database menggunakan PDO
        try {
            // Membuat objek koneksi
            $connection = new connection();
            $conn = $connection->connect();  // Mendapatkan koneksi

            // Pastikan koneksi berhasil
            if ($conn) {
                // Menyiapkan query dengan menambahkan kolom nim
                $sql = "INSERT INTO prestasi_nonakademik 
                        (nim, id_dospem, jenis_kompetisi, tingkat_kompetisi, nama_kompetisi, penyelenggara, peringkat, peran, foto_kegiatan, sertifikat, karya, surat_tugas, tgl_penyelenggaraan) 
                        VALUES (:nim_mahasiswa, :id_dosen_pembimbing, :jenis_kompetisi, :tingkat_kompetisi, :nama_kompetisi, :penyelenggara, :peringkat, :peran, :foto_kegiatan, :sertifikat, :karya, :surat_tugas, :tanggal_penyelenggaraan)";
                
                // Menyiapkan statement
                $stmt = $conn->prepare($sql);

                // Bind parameter
                $stmt->bindParam(':nim_mahasiswa', $nim_mahasiswa);
                $stmt->bindParam(':id_dosen_pembimbing', $id_dosen_pembimbing);
                $stmt->bindParam(':jenis_kompetisi', $jenis_kompetisi);
                $stmt->bindParam(':tingkat_kompetisi', $tingkat_kompetisi);
                $stmt->bindParam(':nama_kompetisi', $nama_kompetisi);
                $stmt->bindParam(':penyelenggara', $penyelenggara);
                $stmt->bindParam(':peringkat', $peringkat);
                $stmt->bindParam(':peran', $peran);
                $stmt->bindParam(':foto_kegiatan', $foto_kegiatan);
                $stmt->bindParam(':sertifikat', $sertifikat);
                $stmt->bindParam(':karya', $karya);
                $stmt->bindParam(':surat_tugas', $surat_tugas);
                $stmt->bindParam(':tanggal_penyelenggaraan', $tanggal_penyelenggaraan);  // Bind tanggal

                // Eksekusi query
                /*
                if ($stmt->execute()) {
                    echo "<p>Data berhasil disimpan!</p>";
                } else {
                    echo "<p>Terjadi kesalahan: " . $stmt->errorInfo()[2] . "</p>";
                }
                */
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>

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
        <h2>Data Prestasi Non-Akademik</h2>
        <form action="up_nonakademik.php" method="POST" enctype="multipart/form-data">
            <label for="nama-kompetisi">Nama Kompetisi</label>
            <input type="text" name="nama-kompetisi" placeholder="Nama Kompetisi" required />
            <label for="id-dosen-pembimbing">ID Dosen Pembimbing</label>
            <input type="text" name="id-dosen-pembimbing" placeholder="ID Dosen Pembimbing" required />
            <label for="nim-mahasiswa">NIM Mahasiswa</label>
            <input type="text" name="nim-mahasiswa" placeholder="NIM Mahasiswa" required />
            <label for="peran">Peran dalam Kompetisi:</label>
            <select name="peran" required>
                <option value="" disabled selected>Pilih Peran</option>
                <option value="Ketua">Ketua</option>
                <option value="Anggota">Anggota</option>
                <option value="Personal">Personal</option>
            </select>
            <label for="jenis-kompetisi">Jenis Kompetisi:</label>
            <select name="jenis-kompetisi" required>
                <option value="" disabled selected>Pilih Jenis Kompetisi</option>
                <option value="Kepenulisan">Kepenulisan</option>
                <option value="Seni">Seni</option>
                <option value="Olahraga">Olahraga</option>
                <option value="Kewirausahaan">Kewirausahaan</option>
                <option value="Ilmiah">Ilmiah</option>
                <option value="Kreativitas">Kreativitas</option>
                <option value="Teknologi">Teknologi</option>
                <option value="Lainnya">Lainnya</option>
            </select>
            <label for="tingkat-kompetisi">Tingkat Kompetisi:</label>
            <select name="tingkat-kompetisi" required>
                <option value="" disabled selected>Pilih Tingkat Kompetisi</option>
                <option value="Internal">Internal</option>
                <option value="Kabupaten/kota">Kabupaten/Kota</option>
                <option value="Provinsi">Provinsi</option>
                <option value="Nasional">Nasional</option>
                <option value="Internasional">Internasional</option>
                <option value="Lainnya">Lainnya</option>
            </select>
            <label for="tanggal-penyelenggaraan">Tanggal Penyelenggaraan</label>
            <input type="date" name="tanggal-penyelenggaraan" required />
            <label for="upload-dokumentasi">Upload Dokumentasi</label>
            <input type="file" name="upload-dokumentasi" />
            <label for="upload-sertifikat">Upload Sertifikat</label>
            <input type="file" name="upload-sertifikat" />
            <label for="upload-karya">Upload Karya</label>
            <input type="file" name="upload-karya" />
            <label for="upload-surat-tugas">Upload Surat Tugas</label>
            <input type="file" name="upload-surat-tugas" />
            <label for="penyelenggara">Penyelenggara</label>
            <input type="text" name="penyelenggara" placeholder="Penyelenggara" required />
            <label for="peringkat">Peringkat:</label>
            <select name="peringkat" required>
                <option value="" disabled selected>Pilih Peringkat</option>
                <option value="Juara 1">Juara 1</option>
                <option value="Juara 2">Juara 2</option>
                <option value="Juara 3">Juara 3</option>
                <option value="Harapan 1">Harapan 1</option>
                <option value="Harapan 2">Harapan 2</option>
                <option value="Harapan 3">Harapan 3</option>
                <option value="Lainnya">Lainnya</option>
            </select>
            <button type="submit">Simpan</button>
        </form>
        <div class="login-link">
            <p><a href="../dashboard/dashboardMahasiswa.php">Kembali</a></p>
        </div>
    </div>
</body>
</html>
