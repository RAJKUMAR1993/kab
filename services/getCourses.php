<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
require_once('config.php');

if(1){
    $id = $_POST['id'];
    // $id="43";
    $sql = mysqli_query($con,"select * from tbl_courses where institute_id='$id' and deleted='0' order by course_name ASC");
    $out=[];
    
    if(mysqli_num_rows($sql)>0){
        while($row = mysqli_fetch_assoc($sql)){
            $row['course_desc']= utf8_encode($row['course_desc']);
            array_push($out,json_encode($row));
        }
        echo json_encode(array("Status"=>"Success","Data"=>$out));
        
    }else{
        echo json_encode(array("Status"=>"Success","Data"=>$out));
    }

}else{
    echo json_encode(array("Status"=>"Wrong"));
}

?>