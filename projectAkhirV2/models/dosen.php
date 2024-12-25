<?php
class dosen extends user {
    public $conn; // Koneksi ke database
    protected $table = "dosen"; // Nama tabel dosen

    // Constructor untuk inisialisasi koneksi
    public function __construct($pdo) {
        $this->conn = $pdo;
    }

    // Fungsi untuk menambahkan data dosen
    public function addDosen($data1) {
        // Query untuk menambahkan data dosen
        $query = "INSERT INTO " . $this->table . " 
                  (nidn, nama, email, no_telp, jabatan, alamat, kota_kelahiran, tgl_lahir, agama) 
                  VALUES 
                  (:nidn, :nama, :email, :no_telp, :jabatan, :alamat, :kota_kelahiran, :tgl_lahir, :agama)";
        $stmt = $this->conn->prepare($query);
    
        // Bind parameter berdasarkan data yang diterima
        $stmt->bindParam(':nidn', $data1['nidn']);
        $stmt->bindParam(':nama', $data1['nama']);
        $stmt->bindParam(':email', $data1['email']);
        $stmt->bindParam(':no_telp', $data1['no_telp']);
        $stmt->bindParam(':jabatan', $data1['jabatan']);
        $stmt->bindParam(':alamat', $data1['alamat']);
        $stmt->bindParam(':kota_kelahiran', $data1['kota_kelahiran']);
        $stmt->bindParam(':tgl_lahir', $data1['tgl_lahir']);
        $stmt->bindParam(':agama', $data1['agama']);
    
        // Eksekusi query
        return $stmt->execute();
    }
    
    public function addPw($data2) {
        // Query untuk menambahkan data login dosen
        $query2 = "INSERT INTO login_dosen (nidn, password) VALUES (:nidn2, :password)";
        $stmt = $this->conn->prepare($query2);
    
        // Bind parameter untuk login dosen
        $stmt->bindParam(':nidn2', $data2['nidn2']);
        $stmt->bindParam(':password', $data2['password']);
    
        return $stmt->execute();
    }
    
    //Fungsi untuk menambahkan data peran dosen pada tabel dosen_pembimbing
    public function addPeran($data1) {
        // Query untuk menambahkan data di tabel dosen_pembimbing
        $query = "INSERT INTO dosen_pembimbing (nidn, peran) VALUES (:nidn, :peran)";
        $stmt = $this->conn->prepare($query);

        // Bind parameter untuk dosen_pembimbing
        $stmt->bindParam(':nidn', $data1['nidn']);
        $stmt->bindParam(':peran', $data1['peran']);

        // Eksekusi query
        if (!$stmt->execute()) {
            throw new Exception("Gagal menambahkan peran dosen pembimbing");
        }
    }

    //Fungsi untuk menampilkan data dosen pembimbing dari tabel dosen_pembimbing
    public function getPeran($nidn) {
        $query = "SELECT * FROM dosen_pembimbing WHERE nidn = :nidn";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nidn', $nidn, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
