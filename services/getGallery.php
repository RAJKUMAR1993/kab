<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
require_once('config.php');

if(1){
    $id = $_POST['id'];
    // $id="43";
    $sql = mysqli_query($con,"select * from tbl_gallery_title where institute_id='$id' and deleted='0' order by gallery_title ASC");
    $out=[];
    
    if(mysqli_num_rows($sql)>0){
        while($row = mysqli_fetch_assoc($sql)){
        $aid = $row['title_id'];
        $sql1 = mysqli_query($con,"select * from tbl_gallery where title_id='$aid' and Status='Active' and deleted='0'");
        if(mysqli_num_rows($sql1) > 0){
            $imgs = [];
            while($row1 = mysqli_fetch_array($sql1)){
            array_push($imgs, array("Image"=>$row1['images']));
            }
            $row['Images'] = $imgs;
        }
            // print_r($row);
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