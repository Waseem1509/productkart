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

$product->name = $data['name'];
$product->price = $data['price'];
$product->rating = $data['rating'];
$product->brand = $data['brand'];
$product->color = $data['color'];
$product->filterForm = $data['filterForm'];

$stmt = $product->filter();
$num = $stmt->rowCount();

if($num>0){
    $products_arr=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
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
} else{
    echo json_encode(array("message" => "No products present"));
}
?>