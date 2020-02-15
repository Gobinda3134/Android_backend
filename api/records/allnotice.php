<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/notice.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$notice = new Notice($db);
 
// query staff
$stmt = $notice->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // staff array
    $notice_arr=array();
    $notice_arr["notice"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $notice_records=array(
            "notice_id" => $notice_id,
            "notice_title" => $notice_title,
            "notice_date" => $notice_date,
            "notice_url" => $noticeurl
			
        );
 
        array_push($notice_arr["notice"], $notice_records);
    }
 
    echo json_encode($notice_arr);
}
 
else{
    echo json_encode(
        array("message" => "No image found.")
    );
}
?>