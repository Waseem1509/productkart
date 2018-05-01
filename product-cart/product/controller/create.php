<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
ini_set("display_errors", E_ALL);
// get database connection
include_once '../../config/fn.database.php';
 
// instantiate product object
include_once '../model/productModel.php';
 
$database = new Database();
$db = $database->getConnection();
 
$product = new ProductModel($db);
// get posted data
$data = $_REQUEST;
//$data = json_decode(file_get_contents('json_data.json', FILE_USE_INCLUDE_PATH));

// set product property values
$product->name = $data['name'];
$product->rating = $data['rating'];
$product->price = $data['price'];
$product->discount = $data['discount'];
$product->brand = $data['brand'];
$product->color = $data['color'];
$product->create_date = date('Y-m-d H:i:s');
 
// create the product
if($product->create()){
    echo '{';
        echo '"message": "Product was created."';
    echo '}';
}
 
// if unable to create the product, tell the user
else{
    echo '{';
        echo '"message": "Unable to create product."';
    echo '}';
}
?>