<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="cssLanding.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Add Chart.js library -->
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
        <div class="statistics">
            <div class="stat-item">
                <h3>Jumlah Prestasi Non-Akademik</h3>
                <p>350</p>
            </div>
            <div class="stat-item">
                <h3>Prestasi Non-Akademik Terverifikasi</h3>
                <p>275</p>
            </div>
            <div class="stat-item">
                <h3>Mahasiswa Berprestasi</h3>
                <p>150</p>
            </div>
        </div>
        <!-- New Section for Chart -->
        <div class="chart-container">
            <canvas id="studentChart"></canvas>
        </div>
    </section>

    <a href="https://wa.me/62895366420366" target="_blank" class="whatsapp-button"></a>
</div>
<footer>
    <p>&copy; 2024 Made with love by Group 2. All rights reserved.</p>
</footer>
<script>
        // Chart.js setup for Bar Chart
        var ctx = document.getElementById('studentChart').getContext('2d');
        var studentChart = new Chart(ctx, {
            type: 'bar', // Bar chart
            data: {
                labels: ['2020', '2021', '2022', '2023'], // Tahun
                datasets: [{
                    label: 'Jurusan TI', 
                    data: [150, 180, 210, 230], // Data mahasiswa TI tiap tahun
                    backgroundColor: '#6a11cb', // Warna ungu untuk TI
                    borderColor: '#6a11cb', // Warna border ungu
                    borderWidth: 1
                }, {
                    label: 'Jurusan SIB',
                    data: [100, 120, 140, 160], // Data mahasiswa SIB tiap tahun
                    backgroundColor: '#00b0ff', // Warna biru untuk SIB
                    borderColor: '#00b0ff', // Warna border biru
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        position: 'top'
                    }
                }
            }
        });
</script>
</body>
</html>
