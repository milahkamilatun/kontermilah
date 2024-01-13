<?php
class penjualandetail{
    // Connection
    private $conn;
    // Table
    private $db_table = "penjualan_detail";
    private $dbm_table = "barang";
    // Columns
    public $id;
    public $trxid;
    public $kd_brg;
    public $nama;
    public $harga_jual;
    public $qty;
    public $sub_total;
    // Db connection
    public function __construct($db){
        $this->conn = $db;
    }
    // GET ALL
    public function getSellDetails(){
        $sqlQuery = "SELECT id, trxid, kd_brg, nama, harga_jual, qty, sub_total FROM ". $this->db_table . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }
    // CREATE
    public function createSellDetail(){
        if($this->checkStok()){
            $sqlQuery = "INSERT INTO ". $this->db_table ."
            SET
            trxid = :trxid,
            kd_brg = :kd_brg,
            nama = :nama,
            harga_jual = :harga_jual,
            qty = :qty,
            sub_total = :sub_total";
            $stmt = $this->conn->prepare($sqlQuery);
            // sanitize
            $this->trxid=htmlspecialchars(strip_tags($this->trxid));
            $this->kd_brg=htmlspecialchars(strip_tags($this->kd_brg));
            $this->nama=htmlspecialchars(strip_tags($this->nama));
            $this->harga_jual=htmlspecialchars(strip_tags($this->harga_jual));
            $this->qty=htmlspecialchars(strip_tags($this->qty));
            $this->sub_total=htmlspecialchars(strip_tags($this->sub_total));
            // bind data
            $stmt->bindParam(":trxid", $this->trxid);
            $stmt->bindParam(":kd_brg", $this->kd_brg);
            $stmt->bindParam(":nama", $this->nama);
            $stmt->bindParam(":harga_jual", $this->harga_jual);
            $stmt->bindParam(":qty", $this->qty);
            $stmt->bindParam(":sub_total", $this->sub_total);
            if($stmt->execute()){
                return true;
            }
            return false;
        } else {
            return false;
        }
    }
    // READ single
    public function checkstok(){
        $sqlQuery = "SELECT
        id,
        kd_brg,
        stok_brg
        FROM
        ". $this->dbm_table ."
        WHERE
        kd_brg = ?
        LIMIT 0,1";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->kd_brg);
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->kd_brg = $dataRow['kd_brg'];
        $stok_brg= $dataRow['stok_brg'];
        $saldo = $stok_brg- $this->qty;
        if($saldo < 0 ){
            return false;
        }else{   
            $this->updatestok($saldo);
            return true;
        }
    }

    public function updatestok($saldo){
        $sqlQuery = "UPDATE
        ". $this->dbm_table ."
        SET
        stok_brg= :stok_brg
        WHERE
        kd_brg = :kd_brg";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(":kd_brg", $this->kd_brg);
        $stmt->bindParam(":stok_brg", $saldo);
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function setDecrease(){
        $sqlQuery = "SELECT
        id,
        trxid,
        kd_brg,
        nama,
        harga_jual,
        qty,
        sub_total
        FROM
        ". $this->db_table ."
        WHERE
        trxid = ?
        LIMIT 0,1";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $dataRow;
    }

    function deleteDetails(){
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE trxid = ?";
        $stmt = $this->conn->prepare($sqlQuery);
        $this->trxid=htmlspecialchars(strip_tags($this->trxid));
        $stmt->bindParam(1, $this->trxid);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

}
?>