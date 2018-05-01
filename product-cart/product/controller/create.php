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
// get posted data
$data = $_REQUEST;

$product->name = $data['name'];
$product->rating = $data['rating'];
$product->price = $data['price'];
$product->discount = $data['discount'];
$product->brand = $data['brand'];
$product->color = $data['color'];
$product->create_date = date('Y-m-d H:i:s');
 
// create the product
if($product->create()){
    echo json_encode(array("message" => "product was created", "status" => "success"));
} else{
    echo json_encode(array("message" => "product could not be created", "status" => "failure"));
}
?>