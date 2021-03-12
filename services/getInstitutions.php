<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
require_once('config.php');

if(1){

    $sql = mysqli_query($con,"select * from tbl_institutes where status='Active' and live_status='1' and is_deleted='0'");
    $out=[];
    
    if(mysqli_num_rows($sql)>0){
        while($row = mysqli_fetch_assoc($sql)){
            $row['aboutinst']=utf8_encode($row['aboutinst']);
            $row['impnote']=utf8_encode($row['impnote']);
            $row['instoffr']=utf8_encode($row['instoffr']);
            $out[]=json_encode($row);
        }
        echo json_encode(array("Status"=>"Success","Data"=>$out));
        
    }else{
        echo json_encode(array("Status"=>"Success","Data"=>$out));
    }

}else{
    echo "rasasd";
}

?>