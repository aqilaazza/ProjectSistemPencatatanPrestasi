<?php
require_once 'config/connection.php';

try {
    // Buat koneksi ke database
    $db = new connection();
    $conn = $db->connect();

    // Jalankan query untuk statistik
    $query = "SELECT * FROM statistik_non_akademik";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    // Ambil hasil query
    $statistik = $stmt->fetchAll(PDO::FETCH_ASSOC);

    
} catch (PDOException $e) {
    // Tampilkan pesan kesalahan jika terjadi masalah dengan query
    echo "console.error('Error fetching statistics: " . $e->getMessage() . "');";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="cssLanding.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Add Chart.js library -->
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
<header>
    <button class="login-button" onclick="window.location.href='login.php'">Masuk</button>
</header>
<div class="container">
    <section class="desc-section">
        <h2>JTI Polinema</h2>
        <p style="text-align: justify;">Prestasi adalah hasil dari usaha dan kerja keras untuk mencapai sesuatu yang membanggakan. Bagi mahasiswa, prestasi bukan cuma soal nilai atau IPK, tapi juga keterlibatan dalam kegiatan seperti lomba, organisasi, atau pengabdian masyarakat. Prestasi menunjukkan kemampuan untuk berkembang, berpikir kreatif, dan menghadapi tantangan. Selain itu, lewat proses meraih prestasi, mahasiswa belajar banyak hal, seperti manajemen waktu, tanggung jawab, dan membangun karakter.  

Prestasi juga bisa membawa dampak positif, bukan cuma buat diri sendiri, tapi juga untuk kampus dan lingkungan sekitar. Jadi, jangan takut untuk mencoba dan terus melangkah maju. Ayo, raih prestasi setinggi-tingginya dan tunjukkan bahwa kamu mampu membawa perubahan!</p>
    </section>
    
    <!-- FAQ Section -->
    <section class="faq-section">
        <h2>FAQ</h2>
        <div class="faq-item">
            <h3>1. Apakah semua mahasiswa bisa memiliki akun tanpa punya prestasi non-akademik?</h3>
            <p>Jawaban: Bisa. Akun dapat dimiliki oleh semua mahasiswa, baik yang memiliki prestasi non-akademik maupun tidak. Yang penting adalah mahasiswa tersebut tetap aktif dan memiliki keinginan untuk terus belajar serta mengembangkan diri.</p>
        </div>
        <div class="faq-item">
            <h3>2. Apakah ada batasan jenis kegiatan yang dianggap sebagai prestasi?</h3>
            <p>Jawaban: Tidak ada batasan. Prestasi bisa berupa apapun yang berdampak positif, seperti memenangkan lomba, menjadi pengurus organisasi, melaksanakan kegiatan sosial, atau bahkan berhasil menyelesaikan proyek pribadi yang bermanfaat.</p>
        </div>
        <div class="faq-item">
            <h3>3. Apakah prestasi yang dapat dicatatumkan hanya diukur dari penghargaan atau sertifikat?</h3>
            <p>Jawaban: Tidak. Prestasi juga bisa berupa pengalaman berharga yang memberikan dampak nyata, seperti menjalankan proyek sosial, membantu orang lain, atau menghasilkan karya yang bermanfaat.</p>
        </div>
    </section>
    
    <!-- Statistics Section -->
    <section class="statistics-section">
    <h2>Statistik Prestasi Non-Akademik</h2>
    <canvas id="statistikChart" style="width: 100%; height: 400px;"></canvas>
</section>
<script>
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

    <a href="https://wa.me/62895366420366" target="_blank" class="whatsapp-button"></a>
</div>
<footer>
    <p>&copy; 2024 Made with love by Group 2. All rights reserved.</p>
</footer>
</body>
</html>