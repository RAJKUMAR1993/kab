<?php 
	include('Crypto.php');
	//error_reporting(0);.
//require_once(APPPATH.'libraries/sendinblue/Mailin.php');

date_default_timezone_set('Asia/Kolkata');

//	$workingKey='C6B73D4C552683B50A859D3E0C449D33';		//test key

$zdata = $this->login_model->get_option("ccavenue");


	$workingKey="$zdata->working_key";		//Working Key should be provided here.
	$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
	$rcvdString=decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
	$order_status="";
	$tracking_id = "";
	$bank_ref_no = "";
	$order_id = "";
	$decryptValues=explode('&', $rcvdString);
	$dataSize=sizeof($decryptValues);
	

	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
		if($i==0) $order_id = $information[1];
		if($i==1) $tracking_id = $information[1];
		if($i==2) $bank_ref_no = $information[1];
		if($i==3) $order_status = $information[1];
		if($i==5) $payment_mode = $information[1];
	}

	$odata= $this->db->get_where("tbl_orders",array("order_id"=>$order_id))->row();
	$oid = $order_id;


	if($order_status==="Success")
	{
		$this->session->set_flashdata(array("payment_status"=>'<div class="alert alert-success alert-dismissible">Your Payment Has Been Successfully Done.</div>'));
		
		
		$data = array("txn_id"=>$tracking_id,"bank_ref_no"=>$bank_ref_no,"payment_status"=>"Success","order_status"=>"Success","date_of_payment"=>date("Y-m-d H:i:s"),"payment_mode"=>$payment_mode);
		
		$this->db->set($data);
		$this->db->where("order_id",$oid);
		$this->db->update("tbl_orders");
		
		if($odata->session_organized_by == "professor"){
			
			$this->payment_meetings->saveprofessorMeeting($oid);
			redirect("professor/profile/".$odata->creator_id);
			
		}elseif($odata->session_organized_by == "speaker"){
			
			$this->payment_meetings->savespeakerMeeting($oid);
			redirect("speaker/profile/".$odata->creator_id);
			
		}
		
	}
	else
	{
		$this->session->set_flashdata(array("payment_status"=>'<div class="alert alert-danger alert-dismissible">Payment Failed</div>'));
		
		$data = array("payment_status"=>"Failed","order_status"=>"Failed");
		
		$this->db->set($data);
		$this->db->where("order_id",$oid);
		$this->db->update("tbl_orders");
		
		if($odata->session_organized_by == "professor"){
		
			redirect("professor/profile/".$odata->creator_id);
			
		}elseif($odata->session_organized_by == "speaker"){
			
			redirect("speaker/profile/".$odata->creator_id);
			
		}
		
	}

//	echo "<br><br>";
//
//	echo "<table cellspacing=4 cellpadding=4>";
//	for($i = 0; $i < $dataSize; $i++) 
//	{
//		$information=explode('=',$decryptValues[$i]);
//	    	echo '<tr><td>'.$information[0].'</td><td>'.$information[1].'</td></tr>';
//	}
//
//	echo "</table><br>";
//	echo "</center>";
?>

