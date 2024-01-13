<?php 
header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json; charset=UTF-8"); 
header("Access-Control-Allow-Methods: POST"); 
header("Access-Control-Max-Age: 3600"); 
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"); 
include_once '../../config/database.php'; 
include_once '../../models/barangs.php'; 
$database = new Database(); 
$db = $database->getConnection(); 
$item = new Barang($db); 
$data = json_decode(file_get_contents("php://input")); 
$item->id = $data->id; 
// employee values 
$item->kd_brg = $data->kd_brg; 
$item->nama_brg = $data->nama_brg; 
$item->harga_brg = $data->harga_brg; 
$item->stok_brg = $data->stok_brg; 
$item->jenis_brg = $data->jenis_brg; 
$item->harga_beli = $data->harga_beli; 
if($item->updateBarang()){ 
    echo json_encode("Employee data updated."); 
    } else{ 
        echo json_encode("Data could not be updated"); 
    } 
?>