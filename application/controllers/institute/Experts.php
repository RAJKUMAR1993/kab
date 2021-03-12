<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');

class Experts extends CI_Controller {
	public function __construct()
	    {
	        parent::__construct();
	        //$this->load->library('excel');
	        if($this->session->userdata['login_type']!='institute'){redirect('institute/login');}
			$this->admin_email = $this->login_model->get_option("admin_email_id")->email;
	    }

	public function index()
	{
		$institute_id =$this->session->userdata['institute_id'];
		$type =$this->session->userdata['login_type'];
		$data['experts'] = $this->expert_model->get_expert($institute_id,$type);
		$data['subview'] = "experts/experts";
		$this->load->view('institute/theme',$data);
	}
	
	public function add(){
		if($this->uri->segment(4)){
			$data['expert'] = $this->expert_model->get_expert_byid($this->uri->segment(4));
		}else{
			$data['expert'] = "";
		}

		$data['subview'] = "experts/add_expert";
		$this->load->view('institute/theme',$data);
	}
	public function bulk(){

		$data['subview'] = "experts/bulk";
		$this->load->view('institute/theme',$data);
	}


	public function save_expert(){

		$data = array(
			"expert_name" => $this->input->post("name"),
			"expert_designation" => $this->input->post("designation"),
			"expert_qualification" => $this->input->post("qualification"),
			"expert_expertise" => $this->input->post("expertise"),
			"expert_shortdesc" => $this->input->post("shortdesc"),
			"expert_longdesc" => $this->input->post("longdesc"),
			"expert_gender" => $this->input->post("gender"),
			"expert_email" => $this->input->post("email"),
			"expert_mobile" => $this->input->post("phone"),
			"expert_status" => $this->input->post("status"),
			"institute_id"	=>$this->session->userdata['institute_id'],
			"login_type" => $this->session->userdata['login_type']
		);

		if($this->uri->segment(4)){
			$data['password'] = $this->institute_login_model->api_key_crypt( $this->input->post("password"),'e');
			$old_password = $this->input->post("old_password");

			if($data['password']!=$old_password){

				$msg = '<html><body>Your password has been updated, please login with below details. <br><small>User ID : '.$data["expert_email"].'</small><br> <small>Password : '.$this->institute_login_model->api_key_crypt($data["password"],"d").'</small></body></html>';
				$from = "$this->admin_email";
				$subject = "Login Details : KAB Education Fair";
				$to = $data['expert_email'];
				$re = $this->login_model->sendMail($from,$to,$subject,$msg);
			}
			$this->db->where("expert_id",$this->input->post("expert_id"))->update("tbl_experts",$data); 
			//redirect("institute/experts");
			$data1=["Status"=>'Active',"Message"=>"Successfully Updated."];
				echo json_encode($data1);
				exit();
		}else{
			$data['password'] = $this->institute_login_model->api_key_crypt(random_string('alnum', 8),"e");
			$check_email = $this->expert_model->check_email($data['expert_email']);
			
			if($check_email){
				$query = $this->db->insert("tbl_experts",$data);
			}else{
				$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">Expert email already exist.!</div>');
				//redirect("institute/experts/add");
				$data1=["Status"=>'InActive',"Message"=>"Expert email already exist."];
			 	echo json_encode($data1);
			 	exit();
			}
			}
			if($query){ 
				$msg = '<html><body><small>User ID : '.$data["expert_email"].'</small><br> <small>Password : '.$this->institute_login_model->api_key_crypt( $data["password"],"d").'</small></body></html>';
				$from = "$this->admin_email";
				$subject = "Login Details : KAB Education Fair";
				$to = $data['expert_mobile'];
				$re = $this->login_model->sendMail($from,$to,$subject,$msg);

				//redirect("institute/experts");
				$data1=["Status"=>'Active',"Message"=>"Successfully Inserted."];
				echo json_encode($data1);
				exit();
			}
			
		}	

	public function delete_expert(){
		if($this->uri->segment(4)){
			$id =$this->uri->segment(4);
			$query = $this->db->where("expert_id",$id)->update("tbl_experts",array('is_deleted' =>'1'));
			if($query){ redirect("institute/experts");}
		}
	}

public function import(){
 	$this->load->library('excel');
  if(isset($_FILES["file"]["name"])){

   $path = $_FILES["file"]["tmp_name"];
   $object = PHPExcel_IOFactory::load($path);
   $error = [];
   foreach($object->getWorksheetIterator() as $worksheet)
   {
    $highestRow = $worksheet->getHighestRow();
    $highestColumn = $worksheet->getHighestColumn();
    $j=0;
    for($row=2; $row<=$highestRow; $row++)
    {
     
     $name = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
     $email = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
     $phone = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
     	
     	$check_email = $this->expert_model->check_email($email);
		if($check_email){
			 $data = array(
				"expert_name" => $name,
				"expert_email" => $email,
				"expert_mobile" => $phone,
				"expert_status" => 'Active',
				"password" =>$this->institute_login_model->api_key_crypt(random_string('alnum', 8),"e"),
				"institute_id"	=>$this->session->userdata['institute_id']
				);
			
			$query = $this->db->insert("tbl_experts",$data);
			if($query){
				$msg = '<html><body><small>User ID : '.$email.'</small><br> <small>Password : '.$this->institute_login_model->api_key_crypt( $data["password"],"d").'</small></body></html>';
				$from = "$this->admin_email";
				$subject = "Login Details : KAB Education Fair";
				$to = $data['expert_mobile'];
				$re = $this->login_model->sendMail($from,$to,$subject,$msg);			
			}
		}else{
			
			$error[$j] = $email; $j++;
		}
    }
  }
  	$this->session->set_flashdata('msg',$error);
  	
   redirect("institute/experts");
   //print_r($error); 
  } 
 }

}
