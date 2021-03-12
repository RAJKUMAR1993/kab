<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
require_once('config.php');
require_once('encrypt.php');

$uname = $_POST['user_email'];
$password = $_POST['user_password'];
$type = $_POST['ltype'];

if($type === 'Student'){

    $sql = mysqli_query($con,"select * from tbl_users where email='$uname'");
    if(mysqli_num_rows($sql)>0){
    $row = mysqli_fetch_array($sql);
    if($row['status'] === 'Active'){
        if($row['password'] == api_key_crypt($password, 'e')){
        echo json_encode(array("Status"=>"Success","Message"=>"Login success","userid"=>$row['id'],"name"=>$row['user_name'],"email"=>$row['email'],"mobile"=>$row['mobile_no']));    
        }else{
        echo json_encode(array("Status"=>"Wrong","Message"=>"Wrong password!"));    
        }
    }else{
        echo json_encode(array("Status"=>"Wrong","Message"=>"Sorry, account is not active."));
    }
    }else{
        echo json_encode(array("Status"=>"Wrong","Message"=>"Wrong username!"));
    }

}else{
    
}

?>