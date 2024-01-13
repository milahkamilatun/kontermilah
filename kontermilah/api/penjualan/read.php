<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-AllowHeaders, Authorization, X-Requested-With");
include_once '../../config/database.php';
include_once '../../models/penjualan.php';

$database = new Database();
$db = $database->getConnection();
if(isset($_GET['id'])){
    $item = new penjualan($db);
    $item->id = isset($_GET['id']) ? $_GET['id'] : die();
    $item->getSinglepenjualan();
    if($item->trxid != null){
        // create array
        $emp_arr = array(
        "id" => $item->id,
        "trxid" => $item->trxid,
        "date_sell" => $item->date_sell,
        "nama_customer" => $item->nama_customer,
        "kasir" => $item->kasir,
        "grand_total" => $item->grand_total
        );
        http_response_code(200);
        echo json_encode($emp_arr);
    }
    else{
        http_response_code(404);
        echo json_encode("Penjualan not found.");
    }
}
else {
    $items = new penjualan($db);
    $stmt = $items->getpenjualan();
    $itemCount = $stmt->rowCount();
    if($itemCount > 0){
        $PenjualanArr = array();
        $PenjualanArr["body"] = array();
        $PenjualanArr["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "trxid" => $trxid,
                "date_sell" => $date_sell,
                "nama_customer" => $nama_customer,
                "kasir" => $kasir,
                "grand_total" => $grand_total
            );
            array_push($PenjualanArr["body"],$e);
        }
        echo json_encode($PenjualanArr);
    }
    else{
        http_response_code(404);
        echo json_encode(array("nama_customer" => "No record found."));
    }
}
?>

