<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
require_once('config.php');
$sql =  mysqli_query($con,"select * from tbl_news where status='Active' and is_deleted='0' order by news_id DESC limit 0,5");
$out =[];
while($row = mysqli_fetch_array($sql)){
    array_push($out,array("id"=>$row['news_id'],"title"=>$row['title']));
}
echo json_encode(array("Status"=>"Success","Data"=>$out));
?>