<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * Developer: Waseem
 */
include_once '../../config/fn.database.php';
include_once '../model/productModel.php';
 
$database = new Database();
$db = $database->getConnection();
 
$product = new ProductModel($db);
 
$data = $_REQUEST;

$product->id = $data['id'];
 
if($product->delete()){
    echo json_encode(array("message" => "product was deleted", "status" => "success"));
} else{
    echo json_encode(array("message" => "product could not be deleted", "status" => "failure"));
}
?>