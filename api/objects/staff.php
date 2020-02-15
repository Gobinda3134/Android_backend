<?php
class Staff{
 
    // database connection and table name
    private $conn;
    private $table_name = "tbl_staff";
 
    // object properties
    public $staff_id;
    public $staff_full_name;
    public $staff_designation;
    public $staff_contact_number;
    public $staff_category;
    public $staff_image_url;
   
 
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