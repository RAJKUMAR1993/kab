<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
require_once('config.php');

if(1){
    // $id = $_POST['id'];
    $id="43";
    $sql = mysqli_query($con,"select * from tbl_achievement where institute_id='$id' and is_deleted='0' order by achievement_id DESC");
    $out=[];
    
    if(mysqli_num_rows($sql)>0){
        while($row = mysqli_fetch_assoc($sql)){
            $row['title'] = utf8_encode($row['title']);
            $row['description'] = utf8_encode($row['description']);
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