<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata Dosen</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="biodata_mahasiswa.css">
</head>
<body>
    <div class="container">
        <h2>Biodata Mahasiswa</h2>
        <form action="#">
            <input type="text" placeholder="NIM" required />
            <input type="text" placeholder="Nama Lengkap" required />
            <input type="email" placeholder="Email" required />
            <select required>
                <option value="" disabled selected hidden>Agama</option>
                <option value="Islam">Islam</option>
                <option value="Kristen">Kristen</option>
                <option value="Hindu">Hindu</option>
                <option value="Buddha">Buddha</option>
                <option value="Konghucu">Konghucu</option>
            </select>
            <input type="text" placeholder="Nama Ortu" required />
            <input type="text" placeholder="Alamat" required />
            <input type="tel" placeholder="No. Telp" required />
            <input type="tel" placeholder="No. Telp Wali" required />
            <input type="tel" placeholder="No. Telp Ortu" required />
            <select required>
                <option value="" disabled selected hidden>Jenis Kelamin</option>
                <option value="Laki-laki">L</option>
                <option value="Perempuan">P</option>
            </select>
            <label for="tglLahir">Tgl Lahir</label>
            <input type="date" id="tglLahir" required />
            <input type="text" placeholder="Kota Kelahiran" required />
            <input type="text" placeholder="Tahun Masuk" required />
            <input type="text" placeholder="Prodi" required />
            
            <button type="submit">Simpan</button>
        </form>

        <div class="login-link">
            <p><a href="../dashboard/dashboardMahasiswa.php">Kembali</a></p>
        </div>
    </div>
</body>
</html>