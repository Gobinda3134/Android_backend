<?php
class Assignment{
 
    // database connection and table name
    private $conn;
    private $table_name = "tbl_assignment";
 
    // object properties
    public $assignment_id;
    public $assignment_cycle;
    public $assignment_subject;
    public $assignment_year;
    public $assignment_deadline;
    public $assignmenturl;
   
 
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