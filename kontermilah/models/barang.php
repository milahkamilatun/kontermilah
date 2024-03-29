<?php
    class Barang{
    // Connection
    private $conn;
    // Table
    private $db_table = "Barang";
    // Columns
    public $id;
    public $kd_brg;
    public $nama_brg;
    public $harga_brg;
    public $stok_brg;
    public $jenis_brg;
    public $harga_beli;
    // Db connection
    public function __construct($db){
        $this->conn = $db;
    }
    // GET ALL
    public function getBarang(){
        $sqlQuery = "SELECT id, kd_brg, nama_brg, harga_brg, stok_brg, jenis_brg, harga_beli FROM "
        . $this->db_table . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }
    // CREATE
    public function createBarang(){
        $sqlQuery = "INSERT INTO
        ". $this->db_table ."
            SET
                kd_brg = :kd_brg,
                nama_brg = :nama_brg,
                harga_brg = :harga_brg,
                stok_brg = :stok_brg,
                jenis_brg = :jenis_brg,
                harga_beli = :harga_beli";
        $stmt = $this->conn->prepare($sqlQuery);
        // sanitize
        $this->kd_brg=htmlspecialchars(strip_tags($this->kd_brg));
        $this->nama_brg=htmlspecialchars(strip_tags($this->nama_brg));
        $this->harga_brg=htmlspecialchars(strip_tags($this->harga_brg));
        $this->stok_brg=htmlspecialchars(strip_tags($this->stok_brg));
        $this->jenis_brg=htmlspecialchars(strip_tags($this->jenis_brg));
        $this->harga_beli=htmlspecialchars(strip_tags($this->harga_beli));
        // bind data
        $stmt->bindParam(":kd_brg", $this->kd_brg);
        $stmt->bindParam(":nama_brg", $this->nama_brg);
        $stmt->bindParam(":harga_brg", $this->harga_brg);
        $stmt->bindParam(":stok_brg", $this->stok_brg);
        $stmt->bindParam(":jenis_brg", $this->jenis_brg);
        $stmt->bindParam(":harga_beli", $this->harga_beli);
        if($stmt->execute()){
        return true;
        }
        return false;
        }
        // READ single
        public function getSingleBarang(){
        $sqlQuery = "SELECT
                    id,
                    kd_brg,
                    nama_brg,
                    harga_brg,
                    stok_brg,
                    jenis_brg,
                    harga_beli
                    FROM
                        ". $this->db_table ."
                    WHERE
                        id = ?
                    LIMIT 0,1";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->kd_brg = $dataRow['kd_brg'];
        $this->nama_brg = $dataRow['nama_brg'];
        $this->harga_brg = $dataRow['harga_brg'];
        $this->stok_brg = $dataRow['stok_brg'];
        $this->jenis_brg = $dataRow['jenis_brg'];
        $this->harga_beli = $dataRow['harga_beli'];
        }
        // UPDATE
        public function updateBarang(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        kd_brg = :kd_brg,
                        nama_brg = :nama_brg,
                        harga_brg = :harga_brg,
                        stok_brg = :stok_brg,
                        jenis_brg = :jenis_brg,
                        harga_beli = :harga_beli
                        WHERE
                        id = :id";
        $stmt = $this->conn->prepare($sqlQuery);

        $this->kd_brg=htmlspecialchars(strip_tags($this->kd_brg));
        $this->nama_brg=htmlspecialchars(strip_tags($this->nama_brg));
        $this->harga_brg=htmlspecialchars(strip_tags($this->harga_brg));
        $this->stok_brg=htmlspecialchars(strip_tags($this->stok_brg));
        $this->jenis_brg=htmlspecialchars(strip_tags($this->jenis_brg));
        $this->harga_beli=htmlspecialchars(strip_tags($this->harga_beli));
        $this->id=htmlspecialchars(strip_tags($this->id));
        // bind data
        $stmt->bindParam(":kd_brg", $this->kd_brg);
        $stmt->bindParam(":nama_brg", $this->nama_brg);
        $stmt->bindParam(":harga_brg", $this->harga_brg);
        $stmt->bindParam(":stok_brg", $this->stok_brg);
        $stmt->bindParam(":jenis_brg", $this->jenis_brg);
        $stmt->bindParam(":harga_beli", $this->harga_beli);
        $stmt->bindParam(":id", $this->id);
        if($stmt->execute()){
        return true;
        }
        return false;
        }
        // DELETE
        function deleteBarang(){
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
        $stmt = $this->conn->prepare($sqlQuery);
        $this->id=htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);
        if($stmt->execute()){
        return true;
        }
        return false;
        }
    }
?>