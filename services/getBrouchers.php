<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
require_once('config.php');

if(1){
    $id = $_POST['id'];
    // $id="43";
    $sql = mysqli_query($con,"select * from tbl_brouchers where institute_id='$id' and deleted='0' order by broucher_id DESC");
    $out=[];
    
    if(mysqli_num_rows($sql)>0){
        while($row = mysqli_fetch_assoc($sql)){
            array_push($out,$row);
        }
        echo json_encode(array("Status"=>"Success","Data"=>$out));
        
    }else{
        echo json_encode(array("Status"=>"Success","Data"=>$out));
    }

}else{
    echo json_encode(array("Status"=>"Wrong"));
}

?>