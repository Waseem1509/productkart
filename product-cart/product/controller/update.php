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
 
// include database and object files
include_once '../../config/fn.database.php';
include_once '../model/productModel.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$product = new ProductModel($db);
 
// get id of product to be edited
//$data = json_decode(file_get_contents("php://input"));
$data = json_decode(file_get_contents('json_data.json', FILE_USE_INCLUDE_PATH));

// set ID property of product to be edited
$product->id = $data->id;
 
// set product property values
$product->name = $data->name;
$product->rating = $data->rating;
$product->price = $data->price;
$product->discount = $data->discount;
$product->brand = $data->brand;
$product->color = $data->color;
 
// update the product
if($product->update()){
    echo '{';
        echo '"message": "Product was updated."';
    echo '}';
}
 
// if unable to update the product, tell the user
else{
    echo '{';
        echo '"message": "Unable to update product."';
    echo '}';
}
?>