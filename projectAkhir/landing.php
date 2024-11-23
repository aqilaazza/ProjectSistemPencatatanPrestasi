<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        header {
            background-image: url('img/header.png'); /* Ganti dengan path gambar Anda */
            background-size: cover; /* Mengatur gambar agar menutupi seluruh area */
            background-position: center; /* Mengatur posisi gambar di tengah */
            color: #fff;
            padding: 100px;
            text-align: center;
            position: relative;
        }

        h1 {
            margin: 0;
            font-size: 3em;
        }

        .login-button {
            position: absolute; /* Position it relative to the header */
            top: 20px; /* Adjust as needed */
            right: 30px; /* Align it to the right */
            background-color: white; /* White background */
            color: #6a11cb; /* Text color matching the theme */
            border: none; /* No border */
            padding: 10px 20px; /* Padding */
            border-radius: 25px; /* Rounded corners */
            cursor: pointer; /* Pointer cursor */
            transition: background-color 0.3s; /* Transition effect */
        }

        .login-button:hover {
            background-color: #e0e0e0; /* Change background on hover */
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            position: relative; /* Enable positioning for the circular button */
        }

        section {
            padding: 40px 0;
            text-align: center;
        }

        .services {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .service {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin: 10px;
            padding: 20px;
            width: 300px;
            transition: transform 0.3s;
        }

        .service:hover {
            transform: translateY(-5px);
        }

        .news-section {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .news-article {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin: 10px;
            padding: 20px;
            width: 90%;
            max-width: 600px;
            transition: transform 0.3s;
        }

        .news-article:hover {
            transform: translateY(-5px);
        }

        .more-button {
            margin-top: 20px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #6a11cb;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .more-button:hover {
            background-color: #5a0e9d;
        }

        footer {
            background: #6a11cb;
            color: #fff;
            text-align: center;
            padding: 20px;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        .whatsapp-button {
            position: fixed; /* Keep it fixed */
            bottom: 0; /* Set it to the bottom */
            right: 30px; /* Align it to the right */
            width: 60px; /* Width of the circular button */
            height: 60px; /* Height of the circular button */
            background: url('img/cs.png') no-repeat center center / cover; /* Background image */
            border-radius: 50%; /* Make it circular */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            transition: transform 0.3s;
            z-index: 10; /* Ensure it appears above other elements */
        }

        .whatsapp-button:hover {
            transform: scale(1.1); /* Scale up on hover */
        }

        .highlight {
            color: #6a11cb; /* Highlight color */
            font-weight: bold; /* Bold text */
        }

        @media (max-width: 768px) {
            .services {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>

<header>
    <button class="login-button" onclick="window.location.href='login.php'">Masuk</button>
</header>

<div class="container">
    <section>
        <h2>Tentang Prestasi.mu</h2>
        <p style="text-align: justify;"><span class ="highlight">Prestasi.mu</span> adalah platform inovatif untuk pencatatan prestasi mahasiswa di Politeknik Negeri Malang. Dirancang untuk meningkatkan efisiensi pengelolaan data, platform ini memungkinkan mahasiswa dengan mudah mengunggah prestasi akademik dan non-akademik. Setiap pengajuan akan diverifikasi oleh dosen, memastikan keabsahan informasi dan membangun kepercayaan antara mahasiswa dan kampus. Fitur seperti notifikasi real-time dan dashboard personal membantu mahasiswa melacak perkembangan prestasi mereka. Dosen juga dapat mengakses dan memverifikasi data dengan cepat, mendukung evaluasi yang lebih akurat. Dengan pendekatan sistematis ini, Prestasi.mu mendorong mahasiswa untuk aktif berprestasi dan mengembangkan budaya prestasi di lingkungan kampus Politekenik Negeri Malang.</p>
    </section>

    <section>
        <h2>Fitur Unggulan Kami</h2>
        <div class="services">
            <div class="service">
                <h3>Service 1</h3>
                <p>Short description of service 1.</p>
            </div>
            <div class="service">
                <h3>Service 2</h3>
                <p>Short description of service 2.</p>
            </div>
            <div class="service">
                <h3>Service 3</h3>
                <p>Short description of service 3.</p>
            </div>
        </div>
    </section>

    <section class="news-section">
        <h2>Berita Terbaru</h2>
        <div class="news-article">
            <h3>Berita 1</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
        <div class="news-article">
            <h3>Berita 2</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
        <div class="news-article">
            <h3>Berita 3</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
        <button class="more-button" onclick="window.location.href='login.php'">More</button>
    </section>

    <a href="https://wa.me/62895366420366" target="_blank" class="whatsapp-button"></a> <!-- Ganti dengan nomor WhatsApp Anda -->
</div>

<footer>
    <p>&copy; 2024 Made with love by Group 2. All rights reserved.</p>
</footer>

</body>
</html>
