<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Prestasi Akademik</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 700px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #34495e;
        }
        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .grades-container {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .course-entry {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 10px;
            margin-bottom: 10px;
            align-items: center;
        }
        .course-entry input[type="number"] {
            width: 100%;
        }
        button {
            background-image: linear-gradient(to right, #5a0e9d, #1e5bc0);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
            
        }

        button:hover {
            background-image: linear-gradient(to right, #5a0e9d, #1e5bc0);
        }

        .btn-submit {
            background-image: linear-gradient(to right, #5a0e9d, #1e5bc0);
            display: block;
            width: 200px;
            margin: 20px auto;
        }

        .btn-submit:hover {
            background-image: linear-gradient(to right, #5a0e9d, #1e5bc0);
        }

        #ipk {
            font-size: 1.2em;
            font-weight: bold;
            color: #2c3e50;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Form Unggah Prestasi Akademik</h1>
        <form id="academicForm">
            <div class="form-group">
                <label for="nama">Nama Lengkap:</label>
                <input type="text" id="nama" name="nama" required>
            </div>
            
            <div class="form-group">
                <label for="nim">NIM:</label>
                <input type="text" id="nim" name="nim" required>
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

            <div class="grades-container">
                <h3>Nilai Mata Kuliah</h3>
                <div id="courseList">
                    <div class="course-entry">
                        <input type="text" placeholder="Nama Mata Kuliah" required>
                        <input type="number" min="0" max="100" placeholder="Nilai (10-100)" required>
                    </div>
                </div>
                <button type="button" onclick="addCourse()">Tambah Mata Kuliah</button>
                <button type="button" onclick="calculateIPK()">Hitung IPK</button>
            </div>

            <div class="form-group">
                <label>IPK:</label>
                <div id="ipk">0.00</div>
            </div>

            <button type="submit" class="btn-submit">Simpan Data</button>
        </form>
    </div>

    <script>
        function getNilaiBobot(nilai) {
            if (nilai >= 85) return 4.0;
            if (nilai >= 75) return 3.5;
            if (nilai >= 70) return 3.0;
            if (nilai >= 65) return 2.5;
            if (nilai >= 60) return 2.0;
            if (nilai >= 50) return 1.0;
            return 0;
        }

        function addCourse() {
            const courseList = document.getElementById('courseList');
            const newCourse = document.createElement('div');
            newCourse.className = 'course-entry';
            newCourse.innerHTML = `
                <input type="text" placeholder="Nama Mata Kuliah" required>
                <input type="number" min="0" max="100" placeholder="Nilai (0-100)" required>
            `;
            courseList.appendChild(newCourse);
        }

        function calculateIPK() {
            const nilaiInputs = document.querySelectorAll('#courseList input[type="number"]');
            let total = 0;
            let validGrades = 0;

            nilaiInputs.forEach(input => {
                const nilai = parseFloat(input.value);
                if (!isNaN(nilai) && nilai >= 0 && nilai <= 100) {
                    total += getNilaiBobot(nilai);
                    validGrades++;
                }
            });

            const ipk = validGrades > 0 ? (total / validGrades).toFixed(2) : '0.00';
            document.getElementById('ipk').textContent = ipk;
        }

        document.getElementById('academicForm').onsubmit = function(e) {
            e.preventDefault();
            alert('Data berhasil disimpan!');
        };
    </script>
</body>
</html>
