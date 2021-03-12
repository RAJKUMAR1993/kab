<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');

class Councellors extends CI_Controller {
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
		$data['experts'] = $this->db->order_by('id', 'DESC')->get_where("tbl_councellors",["institute_id"=>$institute_id,"is_deleted"=>0])->result();
		$data['subview'] = "councellors/councellors";
		$this->load->view('institute/theme',$data);
	}
	
	public function professor_meetings(){
		
		$currentdate = strtotime(date("Y-m-d H:i:s"));
			
		$institute_id = $this->session->userdata['institute_id'];
		$ref = $this->input->get("ref");

		if($ref == "upcoming"){
			$this->db->where("exp_se_time >=",$currentdate);
		}elseif($ref == "completed"){
			$this->db->where("(exp_se_time+(duration*60)) <=",$currentdate);
		}

		
		if($ref == "scheduled"){
			$data['sessions'] = $this->db->where("institute_id",$institute_id)->order_by("exp_std_id","desc")->get("tbl_counsellor_student_schedule")->result();
		}else{
			$data['sessions'] = $this->db->where("institute_id",$institute_id)->order_by("exp_se_id","desc")->get("tbl_counsellor_sessions")->result();
		}

		$data["completed"] = $this->db->get_where("tbl_counsellor_sessions",["institute_id"=>$this->session->userdata['institute_id'],"(exp_se_time+(duration*60)) <="=>$currentdate])->num_rows();
		
		$data["upcoming"] = $this->db->get_where("tbl_counsellor_sessions",["institute_id"=>$this->session->userdata['institute_id'],"exp_se_time >="=>$currentdate])->num_rows();
		
		$data["booked"] = $this->db->query("SELECT * FROM tbl_counsellor_student_schedule WHERE institute_id=$institute_id")->num_rows();
		$data['subview'] = "professors/professor_meetings";
		$this->load->view('institute/theme',$data);
		
	}
	
	public function viewMeetings($id=""){
		
		$institute_id =$this->session->userdata['institute_id'];
		$currentdate = strtotime(date("Y-m-d H:i:s"));
		
		
		if($id){
			
			$expert_query = "and expert_id=$id";
			
		}
		
		$data['meetings'] = $this->db->query("SELECT * FROM tbl_counsellor_student_schedule WHERE exp_std_time >=$currentdate $expert_query and institute_id=$institute_id")->result();
		
		$data['progress'] = $this->db->query("SELECT * FROM tbl_counsellor_student_schedule WHERE is_deleted=0 $expert_query and institute_id=$institute_id and exp_std_time <=$currentdate and (exp_std_time+(exp_std_duration*60)) >= $currentdate")->result();
		
        $data['cmeetings'] = $this->db->query("SELECT * FROM tbl_counsellor_student_schedule WHERE (exp_std_time+(exp_std_duration*60)) <= $currentdate $expert_query and institute_id=$institute_id")->result();
		$data['subview'] = "councellors/councellors_meetings";
		$this->load->view('institute/theme',$data);
		
	}
	
	public function add(){
		if($this->uri->segment(4)){
			$data['expert'] = $this->db->get_where("tbl_councellors",["id"=>$this->uri->segment(4)])->row();
		}else{
			$data['expert'] = "";
		}

		$data['subview'] = "councellors/add_councellor";
		$this->load->view('institute/theme',$data);
	}
	public function bulk(){

		$data['subview'] = "experts/bulk";
		$this->load->view('institute/theme',$data);
	}


	public function save_expert(){

		$data = array(
			"expert_name" => $this->input->post("name"),
			"expert_email" => $this->input->post("email"),
			"expert_mobile" => $this->input->post("phone"),
			"expert_status" => $this->input->post("status"),
			"institute_id"	=>$this->session->userdata['institute_id']
		);
		$id = $this->uri->segment(4);
		
		$chkEmail1 = $this->db->where("expert_email", $data['expert_email'])->where("is_deleted", 0);
		if($id){
			$chkEmail1 = $chkEmail1->where("id!=", $id);
		}
		$chkEmail1 = $chkEmail1->get("tbl_councellors");
		
		if($chkEmail1->num_rows()>0){
			
			$data1=["Status"=>'InActive',"Message"=>"Admission Officer email already exist."];
			echo json_encode($data1);
			exit();
			
		}
		
		if($id){
			$data['password'] = $this->institute_login_model->api_key_crypt( $this->input->post("password"),'e');
			$old_password = $this->input->post("old_password");

			if($data['password']!=$old_password){

				$msg = '<html><body>Your password has been updated, please login with below details. <br><small>User ID : '.$data["expert_email"].'</small><br> <small>Password : '.$this->institute_login_model->api_key_crypt($data["password"],"d").'</small></body></html>';
				$from = "$this->admin_email";
				$subject = "Login Details : KAB Education Fair";
				$to = $data['expert_email'];
				$re = $this->login_model->sendMail($from,$to,$subject,$msg);
			}
			$this->db->where("id",$this->input->post("expert_id"))->update("tbl_councellors",$data); 
			//redirect("institute/experts");
			$data1=["Status"=>'Active',"Message"=>"Successfully Updated."];
				echo json_encode($data1);
				exit();
		}else{
			$data['password'] = $this->institute_login_model->api_key_crypt(random_string('alnum', 8),"e");
			$check_email = $this->db->get_where("tbl_councellors",["expert_email"=>$data['expert_email'],"institute_id"	=>$this->session->userdata['institute_id'],"is_deleted"=>0])->row();
			
			if(!$check_email){
				
				$counCheck = $this->db->get_where("tbl_councellors",["institute_id"	=>$this->session->userdata['institute_id'],"is_deleted"=>0])->num_rows();
				
				$idata = $this->db->get_where("tbl_institutes",["institute_id"=>$this->session->userdata("institute_id")])->row();
				
				if($idata->add_package_status == "Active"){
					
					$adpackage = json_decode($idata->additional_package_count)->coucellors;
					
				}else{
					
					$adpackage = 0;
					
				}
				
				$icount = (json_decode($idata->allowed_creation_count)->coucellors + $adpackage);
				
				
				if($counCheck >= $icount){
					
					$data1=["Status"=>'InActive',"Message"=>"You Can Create Upto $icount Admission Officers Only."];
					echo json_encode($data1);
					exit();
					
				}else{
					
					$query = $this->db->insert("tbl_councellors",$data);
					
				}
			}else{
				$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">Admission Officer email already exist.!</div>');
				//redirect("institute/experts/add");
				$data1=["Status"=>'InActive',"Message"=>"Admission Officer email already exist."];
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
			$query = $this->db->where("id",$id)->update("tbl_councellors",array('is_deleted' =>'1'));
			if($query){ redirect("institute/councellors");}
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
