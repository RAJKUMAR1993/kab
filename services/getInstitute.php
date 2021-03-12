<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
require_once('config.php');

if(1){
    $id = $_POST['id'];
    // $id="56";
    $sql = mysqli_query($con,"select * from tbl_institutes where institute_id='$id'");
    $row = mysqli_fetch_assoc($sql);
    $row['aboutinst']=utf8_encode($row['aboutinst']);
    $row['impnote']=utf8_encode($row['impnote']);
    $row['instoffr']=utf8_encode($row['instoffr']);

    echo json_encode(array("Status"=>"Success","Data"=>json_encode($row),"Out"=>$id));

}else{
    echo json_encode(array("Status"=>"Wrong"));
}

?>