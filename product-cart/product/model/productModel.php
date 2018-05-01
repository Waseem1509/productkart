<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ProductModel{
 
    // database connection and table name
    private $conn;
    private $table_name = "product_details";
 
    // object properties
    public $id;
    public $name;
    public $rating;
    public $price;
    public $discount;
    public $brand;
    public $color;
    public $create_date;
    public $filterForm;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    
    // create product
    function create(){
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    name=:name, rating=:rating, price=:price, discount=:discount, brand=:brand, color=:color, create_date=:create_date";
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->rating=htmlspecialchars(strip_tags($this->rating));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->discount=htmlspecialchars(strip_tags($this->discount));
        $this->brand=htmlspecialchars(strip_tags($this->brand));
        $this->color=htmlspecialchars(strip_tags($this->color));
        $this->create_date=htmlspecialchars(strip_tags($this->create_date));

        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":rating", $this->rating);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":discount", $this->discount);
        $stmt->bindParam(":brand", $this->brand);
        $stmt->bindParam(":color", $this->color);
        $stmt->bindParam(":create_date", $this->create_date);

        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    
    // read products
    function filter(){

        // select all query
        $query = "SELECT * from " . $this->table_name;
                //. " where name=:name and rating=:rating and brand=:brand and color=:color";
        
        // prepare query statement
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
        
        $stmt = $this->conn->prepare($query);
        
        // execute query
        $stmt->execute();

        return $stmt;
    }
    
    // update the product
    function update(){

        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    name=:name, rating=:rating, price=:price, discount=:discount, brand=:brand, color=:color
                WHERE
                    id = :id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->rating=htmlspecialchars(strip_tags($this->rating));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->discount=htmlspecialchars(strip_tags($this->discount));
        $this->brand=htmlspecialchars(strip_tags($this->brand));
        $this->color=htmlspecialchars(strip_tags($this->color));
        $this->id=htmlspecialchars(strip_tags($this->id));
        
        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":rating", $this->rating);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":discount", $this->discount);
        $stmt->bindParam(":brand", $this->brand);
        $stmt->bindParam(":color", $this->color);
        $stmt->bindParam(":id", $this->id);
        
        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }
    
    // delete the product
    function delete(){

        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));

        // bind id of record to delete
        $stmt->bindParam(1, $this->id);

        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }
}