<?php
class connection {
    private $host = "LAPTOP-83QPKDTF\\SQLEXPRESS"; // Nama server\nama_instance
    private $database = "sistemprestasi";          // Nama database
    private $uid = "";                             // Username database (kosongkan jika tidak ada)
    private $pwd = "";                             // Password database
    private $conn = null;                          // Properti untuk menyimpan koneksi

    // Metode untuk membuat koneksi
    public function connect(): PDO {
        if ($this->conn === null) {
            try {
                $dsn = "sqlsrv:Server=$this->host;Database=$this->database";
                $this->conn = new PDO($dsn, $this->uid, $this->pwd);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $exception) {
                die("Connection error: " . $exception->getMessage());
            }
        }
        return $this->conn;
    }

    // Metode untuk menutup koneksi (opsional, PDO biasanya menutup koneksi otomatis)
    public function disconnect() {
        $this->conn = null;
    }
}
?>

