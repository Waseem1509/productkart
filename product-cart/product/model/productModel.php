<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * Developer: Waseem
 */

class ProductModel{
    private $conn;
    private $table_name = "product_details";
 
    public $id;
    public $name;
    public $rating;
    public $price;
    public $discount;
    public $brand;
    public $color;
    public $create_date;
    public $filterForm;
 
    // constructor for database connection
    public function __construct($db){
        $this->conn = $db;
    }
    
    // create product
    function create(){
        $query = "INSERT INTO " . $this->table_name . " SET
                name=:name, rating=:rating, price=:price, discount=:discount,
                brand=:brand, color=:color, create_date=:create_date";
        
        $stmt = $this->conn->prepare($query);
        
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->rating=htmlspecialchars(strip_tags($this->rating));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->discount=htmlspecialchars(strip_tags($this->discount));
        $this->brand=htmlspecialchars(strip_tags($this->brand));
        $this->color=htmlspecialchars(strip_tags($this->color));
        $this->create_date=htmlspecialchars(strip_tags($this->create_date));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":rating", $this->rating);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":discount", $this->discount);
        $stmt->bindParam(":brand", $this->brand);
        $stmt->bindParam(":color", $this->color);
        $stmt->bindParam(":create_date", $this->create_date);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
    
    //Fetch products
    function filter(){
        $query = "SELECT * from " . $this->table_name;
        
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->rating=htmlspecialchars(strip_tags($this->rating));
        $this->brand=htmlspecialchars(strip_tags($this->brand));
        $this->color=htmlspecialchars(strip_tags($this->color));
        if (!empty($this->name)) {
            $where[] = " name='" . $this->name . "'";
        }
        if (!empty($this->rating)) {
            $where[] = " rating='" . $this->rating . "'";
        }
        if (!empty($this->brand)) {
            if ($this->filterForm == 2) {
                $where[] = " brand like'%" . $this->brand . "%'";
            } else {
                $where[] = " brand='" . $this->brand . "'";
            }
        }
        if (!empty($this->color)) {
            $where[] = " color='" . $this->color . "'";
        }
        if (!empty($this->price)) {
            $where[] = " price='" . $this->price . "'";
        }
        if (count($where) > 0) {
            $query .= " where " . implode(" and", $where);
        }
        $query .= " order by id desc";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    
    // delete the product
    function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE id =:id";
        $stmt = $this->conn->prepare($query);
        $this->id=htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(":id", $this->id);
        if($stmt->execute())
            return true;
        return false;
    }
}