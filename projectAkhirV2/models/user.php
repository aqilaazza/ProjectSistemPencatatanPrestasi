<?php
class user {
    protected $conn;
    protected $table;

    public $id;
    public $nama;
    public $email;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Mendapatkan semua data (metode generik)
    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // Menghapus data berdasarkan ID
    public function delete($id, $field = 'id') {
        $query = "DELETE FROM " . $this->table . " WHERE $field = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

     // Mengembalikan nama tabel yang digunakan
     public function getTable() {
        return $this->table;
    }
}
?>
