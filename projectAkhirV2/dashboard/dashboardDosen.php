<?php
session_start();

// Pastikan dosen sudah login
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'dosen') {
    die("Akses ditolak. Anda harus login terlebih dahulu.");
}

$nidn = $_SESSION['nidn'];
$nama = $_SESSION['nama'];

require_once '../config/connection.php';
$conn = (new connection())->connect();

// Query untuk mendapatkan data dosen
$query = "SELECT * FROM dosen WHERE nidn = :nidn";
$stmt = $conn->prepare($query);
$stmt->bindParam(':nidn', $nidn);
$stmt->execute();
$dosen = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$dosen) {
    die("Data dosen tidak ditemukan.");
}

// Query untuk statistik prestasi non-akademik berdasarkan tahun
$queryStatistik = "SELECT YEAR(tgl_penyelenggaraan) AS tahun, COUNT(*) AS jumlah 
                   FROM prestasi_nonakademik
                   WHERE status_validasi = 'diterima'
                   GROUP BY YEAR(tgl_penyelenggaraan)
                   ORDER BY tahun ASC";
$stmtStatistik = $conn->prepare($queryStatistik);
$stmtStatistik->execute();
$statistik = $stmtStatistik->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dosen</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="cssDosen.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Mengatur ukuran canvas agar grafik lebih kecil */
        #statistikChart {
            width: 80% !important;
            height: 300px !important; /* Anda bisa menyesuaikan tinggi ini */
            margin: auto;
        }
        /* Menyesuaikan tampilan statistik */
        .statistics {
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="sidebar" id="sidebar">
        <h2>Dashboard</h2>
        <ul>
            <li><a href="#">Beranda</a></li>
            <li><a href="../dosen/biodata_dosen.php">Profil Saya</a></li>
            <li><a href="../dosen/prestasi_akademik_dosen.php">Prestasi Akademik</a></li>
            <li><a href="../dosen/nonakademik.php">Prestasi Non-Akademik</a></li>
            <li><a href="#" onclick="confirmLogout()">Keluar</a></li>
        </ul>
    </div>

    <div class="main-content" id="main-content">
        <div class="header">
            <h1>Selamat Datang, <?php echo htmlspecialchars($dosen['nama']); ?>!</h1>
        </div>
        
        <div class="statistics">
            <h2>Statistik Prestasi Non-Akademik</h2>
            <canvas id="statistikChart"></canvas>
        </div>
    </div>

    <script>
        function confirmLogout() {
            const confirmed = window.confirm("Apakah Anda yakin keluar?");
            if (confirmed) {
                window.location.href = "../index.php?message=logout";
            }
        }

        // Data statistik dari PHP
        const statistikData = <?php echo json_encode($statistik); ?>;

        // Memproses data untuk grafik
        const labels = statistikData.map(item => item.tahun);
        const data = statistikData.map(item => item.jumlah);

        // Membuat grafik menggunakan Chart.js
        const ctx = document.getElementById('statistikChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Prestasi Non-Akademik',
                    data: data,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Prestasi'
                        },
                        ticks: {
                            maxTicksLimit: 5 // Membatasi jumlah tanda pada sumbu Y
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Tahun'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                responsive: true, // Menyesuaikan ukuran grafik dengan ukuran layar
                maintainAspectRatio: false // Membiarkan grafik menyesuaikan lebar dan tinggi secara bebas
            }
        });
    </script>
</body>
</html>
