<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/assignment.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$assignment = new Assignment($db);
 
// query staff
$stmt = $assignment->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // staff array
    $assignment_arr=array();
    $assignment_arr["assignment"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $assignment_records=array(
            "assignment_id" => $assignment_id,
            "assignment_subject" => $assignment_subject,
            "assignment_year" => $assignment_year,
            "assignment_deadline"=>$assignment_deadline,
            "assignmenturl" => $assignmenturl
			
        );
 
        array_push($assignment_arr["assignment"], $assignment_records);
    }
 
    echo json_encode($assignment_arr);
}
 
else{
    echo json_encode(
        array("message" => "No file found.")
    );
}
?>