<?php
class Admin extends User {
    protected $table = "admin"; // Nama tabel di database

    // Constructor untuk menerima koneksi database
    public function __construct($db) {
        parent::__construct($db); // Panggil konstruktor parent
    }

    // Fungsi untuk memeriksa apakah NIP sudah ada di database
    public function nipExists($nip) {
        $query = "SELECT COUNT(*) FROM " . $this->table . " WHERE nip = :nip";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nip', $nip);
        $stmt->execute();
        
        // Jika hasil query lebih dari 0, berarti NIP sudah ada
        return $stmt->fetchColumn() > 0;
    }

    // Menambahkan data admin
    public function create($data) {
        $query = "INSERT INTO " . $this->table . " (nip, nama, email, no_telp, alamat) 
                  VALUES (:nip, :nama, :email, :no_telp, :alamat)";
        
        // Siapkan query
        $stmt = $this->conn->prepare($query);

        // Bind parameter dengan data yang diterima dari form
        $stmt->bindParam(':nip', $data['nip']);
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':no_telp', $data['no_telp']);
        $stmt->bindParam(':alamat', $data['alamat']);

        // Eksekusi query dan kembalikan hasilnya
        return $stmt->execute();
    }

    // Mengupdate data admin
    public function update($nip, $data) {
        $query = "UPDATE " . $this->table . " SET nama = :nama, email = :email, no_telp = :no_telp, alamat = :alamat WHERE nip = :nip";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nip', $nip);
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':no_telp', $data['no_telp']);
        $stmt->bindParam(':alamat', $data['alamat']);

        return $stmt->execute();
    }
}
?>