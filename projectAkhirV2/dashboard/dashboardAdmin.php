<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="cssAdmin.css">
</head>
<body>

    <div class="sidebar">
        <h2>Dashboard Admin</h2>
        <ul>
            <li><a href="#">Beranda</a></li>
            <li><a href="../admin/biodata_admin.php">Biodata Admin</a></li>
            <li><a href="../admin/biodata_dosen.php">Biodata Dosen</a></li>
            <li><a href="../admin/biodata_mahasiswa.php">Biodata Mahasiswa</a></li>
            <li><a href="../admin/ipMhs.php">Unggah IP Mahasiswa</a></li>
            <li><a href="../admin/validasi_prestasi.php">Validasi Prestasi Non-Akademik</a></li>
            <li><a href="#" onclick="confirmLogout()">Keluar</a></li>
        </ul>
    </div>

    <div class="main-content" id="main-content">
        <div class="header">
            <h1>Selamat Datang, [Admin]!</h1>
        </div>

        <div class="card">
            <h2>Jadwal Piket Admin Validator Prestasi.mu</h2>
            <table class="jadwal-piket-table" id="jadwal-piket-table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Hari</th>
                        <th>Jam</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will be inserted here by JavaScript -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Array of jadwal piket admin
        const jadwalPiket = [
            { nama: "Dian Kurniawan", hari: "Senin", jam: "08:00 - 12:00" },
            { nama: "Rizki Aditya", hari: "Selasa", jam: "12:00 - 16:00" },
            { nama: "Nadia Wulandari", hari: "Rabu", jam: "08:00 - 12:00" }
        ];

        // Function to render the schedule table
        function renderJadwalPiket() {
            const tableBody = document.querySelector("#jadwal-piket-table tbody");
            jadwalPiket.forEach(item => {
                const row = document.createElement("tr");
                
                // Create and append Nama cell
                const tdNama = document.createElement("td");
                tdNama.textContent = item.nama;
                row.appendChild(tdNama);
                
                // Create and append Hari cell
                const tdHari = document.createElement("td");
                tdHari.textContent = item.hari;
                row.appendChild(tdHari);
                
                // Create and append Jam cell
                const tdJam = document.createElement("td");
                tdJam.textContent = item.jam;
                row.appendChild(tdJam);
                
                // Append the row to the table body
                tableBody.appendChild(row);
            });
        }

        // Call render function when page loads
        renderJadwalPiket();

        // Logout confirmation function
        function confirmLogout() {
            const confirmed = window.confirm("Apakah Anda yakin keluar?");
            if (confirmed) {
                window.location.href = "../index.php?message=logout";
            } else {
                window.location.href = "../dashboard/dashboardAdmin.php";
            }
        }
    </script>
</body>
</html>
