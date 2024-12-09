<?php
class dosen extends user {
    public $conn; // Koneksi ke database
    protected $table = "dosen"; // Nama tabel dosen

    // Constructor untuk inisialisasi koneksi
    public function __construct($pdo) {
        $this->conn = $pdo;
    }

    // Fungsi untuk menambahkan data dosen
    public function addDosen($nidn, $nama, $email, $no_telp, $jabatan, $alamat, $kota_kelahiran, $tgl_lahir, $agama) {
        $query = "INSERT INTO " . $this->table . " 
                  (nidn, nama, email, no_telp, jabatan, alamat, kota_kelahiran, tgl_lahir, agama) 
                  VALUES 
                  (:nidn, :nama, :email, :no_telp, :jabatan, :alamat, :kota_kelahiran, :tgl_lahir, :agama)";
        $stmt = $this->conn->prepare($query);

        // Bind parameter
        $stmt->bindParam(':nidn', $nidn);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':no_telp', $no_telp);
        $stmt->bindParam(':jabatan', $jabatan);
        $stmt->bindParam(':alamat', $alamat);
        $stmt->bindParam(':kota_kelahiran', $kota_kelahiran);
        $stmt->bindParam(':tgl_lahir', $tgl_lahir);
        $stmt->bindParam(':agama', $agama);

        // Eksekusi query
        return $stmt->execute();
    }

    // Fungsi untuk mengupdate data dosen berdasarkan NIDN
    public function updateDosen($nidn, $nama, $email, $no_telp, $jabatan, $alamat, $kota_kelahiran, $tgl_lahir, $agama) {
        $query = "UPDATE " . $this->table . " 
                  SET nama = :nama, email = :email, no_telp = :no_telp, jabatan = :jabatan, 
                      alamat = :alamat, kota_kelahiran = :kota_kelahiran, tgl_lahir = :tgl_lahir, agama = :agama 
                  WHERE nidn = :nidn";
        $stmt = $this->conn->prepare($query);

        // Bind parameter
        $stmt->bindParam(':nidn', $nidn);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':no_telp', $no_telp);
        $stmt->bindParam(':jabatan', $jabatan);
        $stmt->bindParam(':alamat', $alamat);
        $stmt->bindParam(':kota_kelahiran', $kota_kelahiran);
        $stmt->bindParam(':tgl_lahir', $tgl_lahir);
        $stmt->bindParam(':agama', $agama);

        // Eksekusi query
        return $stmt->execute();
    }

    // Fungsi untuk menghapus data dosen berdasarkan NIDN
    public function deleteDosen($nidn) {
        $query = "DELETE FROM " . $this->table . " WHERE nidn = :nidn";
        $stmt = $this->conn->prepare($query);

        // Bind parameter
        $stmt->bindParam(':nidn', $nidn);

        // Eksekusi query
        return $stmt->execute();
    }
}
?>
