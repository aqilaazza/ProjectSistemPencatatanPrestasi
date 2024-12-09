<?php
class mahasiswa extends User {
    protected $table = "mahasiswa"; // Nama tabel untuk mahasiswa

    public $nim;

    public function __construct($conn) {
        $this->conn = $conn; // Menyimpan koneksi dalam properti $conn
    }

    public function getAll() {
        $sql = "SELECT m.*, p.nama_prodi
                FROM mahasiswa m
                JOIN prodi p ON m.id_prodi = p.id_prodi";  // Join dengan tabel prodi
        $stmt = $this->conn->prepare($sql); // Menggunakan koneksi $conn
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Menambahkan data mahasiswa
    public function create($data) {
    $query = "INSERT INTO " . $this->table . " (nim, nama_lengkap, email, agama, nama_ortu, alamat, no_telp, no_telp_wali, no_telp_ortu, jenis_kelamin, tgl_lahir, kota_kelahiran, tahun_masuk, id_prodi) VALUES (:nim, :nama_lengkap, :email, :agama, :nama_ortu, :alamat, :no_telp, :no_telp_wali, :no_telp_ortu, :jenis_kelamin, :tgl_lahir, :kota_kelahiran, :tahun_masuk, :id_prodi)";
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(':nim', $data['nim']);
    $stmt->bindParam(':nama_lengkap', $data['nama_lengkap']);
    $stmt->bindParam(':email', $data['email']);
    $stmt->bindParam(':agama', $data['agama']);
    $stmt->bindParam(':nama_ortu', $data['nama_ortu']);
    $stmt->bindParam(':alamat', $data['alamat']);
    $stmt->bindParam(':no_telp', $data['no_telp']);
    $stmt->bindParam(':no_telp_wali', $data['no_telp_wali']);
    $stmt->bindParam(':no_telp_ortu', $data['no_telp_ortu']);
    $stmt->bindParam(':jenis_kelamin', $data['jenis_kelamin']);
    $stmt->bindParam(':tgl_lahir', $data['tgl_lahir']);
    $stmt->bindParam(':kota_kelahiran', $data['kota_kelahiran']);
    $stmt->bindParam(':tahun_masuk', $data['tahun_masuk']);
    $stmt->bindParam(':id_prodi', $data['id_prodi']);

    return $stmt->execute();
}

public function getIdProdiByName($namaProdi) {
    $query = "SELECT id_prodi FROM prodi WHERE nama_prodi = :nama_prodi";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':nama_prodi', $namaProdi);
    $stmt->execute();
    return $stmt->fetchColumn();
}

public function update($nim, $data) {
    try {
        $sql = "UPDATE mahasiswa 
                SET id_prodi = :id_prodi, 
                    nama_lengkap = :nama_lengkap, 
                    email = :email, 
                    no_telp = :no_telp, 
                    agama = :agama, 
                    nama_ortu = :nama_ortu, 
                    jenis_kelamin = :jenis_kelamin, 
                    kota_kelahiran = :kota_kelahiran, 
                    tgl_lahir = :tgl_lahir, 
                    tahun_masuk = :tahun_masuk, 
                    no_telp_ortu = :no_telp_ortu, 
                    no_telp_wali = :no_telp_wali 
                WHERE nim = :nim";
        
        $query = $this->conn->prepare($sql);
        $query->bindParam(':id_prodi', $data['id_prodi']);
        $query->bindParam(':nama_lengkap', $data['nama_lengkap']);
        $query->bindParam(':email', $data['email']);
        $query->bindParam(':no_telp', $data['no_telp']);
        $query->bindParam(':agama', $data['agama']);
        $query->bindParam(':nama_ortu', $data['nama_ortu']);
        $query->bindParam(':jenis_kelamin', $data['jenis_kelamin']);
        $query->bindParam(':kota_kelahiran', $data['kota_kelahiran']);
        $query->bindParam(':tgl_lahir', $data['tgl_lahir']);
        $query->bindParam(':tahun_masuk', $data['tahun_masuk']);
        $query->bindParam(':no_telp_ortu', $data['no_telp_ortu']);
        $query->bindParam(':no_telp_wali', $data['no_telp_wali']);
        $query->bindParam(':nim', $nim);

        return $query->execute();
    } catch (PDOException $e) {
        throw $e;
    }
}
}
?>
