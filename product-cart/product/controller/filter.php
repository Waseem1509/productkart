<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../../config/fn.database.php';
include_once '../model/productModel.php';

//ini_set("display_errors", E_ALL);

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$product = new ProductModel($db);
 
$data = $_REQUEST;

$product->name = $data['name'];
$product->price = $data['price'];
$product->rating = $data['rating'];
$product->brand = $data['brand'];
$product->color = $data['color'];
$product->filterForm = $data['filterForm'];

$stmt = $product->filter();

$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $products_arr=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $product_item=array(
            "id" => $id,
            "name" => $name,
            "rating" => $rating,
            "price" => $price,
            "discount" => $discount,
            "brand" => $brand,
            "color"=> $color,
            "create_date"=>$create_date
        );
 
        array_push($products_arr, $product_item);
    }
 
    echo json_encode($products_arr);
}
 
else{
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>