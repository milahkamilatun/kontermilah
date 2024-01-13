<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../../config/database.php';
include_once '../../models/barang.php';
$database = new Database();
$db = $database->getConnection();
if(isset($_GET['id'])){
    
    $item = new Barang($db);
    $item->id = isset($_GET['id']) ? $_GET['id'] : die();
    $item->getSingleBarang();
    if($item->kd_brg != null){
        // create array
        $bayar_arr = array(
        "id" => $item->id,
        "kd_brg" => $item->kd_brg,
        "nama_brg" => $item->nama_brg,
        "harga_brg" => $item->harga_brg,
        "stok" => $item->stok_brg,
        "jenis_brg" => $item->jenis_brg,
        "harga_beli" => $item->harga_beli
        );

        http_response_code(200);
        echo json_encode($barang_arr);
    }
    else{

        http_response_code(404);
        echo json_encode("Barang not found.");
    }
}
else {
    
    $items = new Barang($db);
    $stmt = $items->getBarang();
    $itemCount = $stmt->rowCount();
    if($itemCount > 0){
        $BarangArr = array();
        $BarangArr["body"] = array();
        $BarangArr["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $e = array(
                "id" => $row['id'],
                "kd_brg" => $row['kd_brg'],
                "nama_brg" => $row['nama_brg'],
                "stok_brg" => $row['stok_brg'],
                "harga_brg" => $row['harga_brg'],
                "jenis_brg" => $row['jenis_brg'],
                "harga_beli" => $row['harga_beli']
            );
            array_push($BarangArr["body"], $e);
        }
        echo json_encode($BarangArr);
    }
    else{
        http_response_code(404);
        echo json_encode(array("messstock" => "No record found."));
    }
}
?>