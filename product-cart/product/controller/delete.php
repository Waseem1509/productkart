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
 
 
// include database and object file
include_once '../../config/fn.database.php';
include_once '../model/productModel.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$product = new ProductModel($db);
 
// get product id
$data = $_REQUEST;
// set product id to be deleted
$product->id = $data['id'];
 
// delete the product
if($product->delete()){
    echo '{';
        echo '"message": "Product was deleted."';
    echo '}';
}
 
// if unable to delete the product
else{
    echo '{';
        echo '"message": "Unable to delete object."';
    echo '}';
}
?>