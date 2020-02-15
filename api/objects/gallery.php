<?php
class Gallery{
 
    // database connection and table name
    private $conn;
    private $table_name = "tbl_gallery";
 
    // object properties
    public $image_id;
    public $image_name;
    public $image_caption;
    public $gallery_url;
   
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
function read(){
 
    // select all query
    $query = "SELECT * FROM " .$this->table_name . "";
                
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}
}