<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');

class Speakers extends CI_Controller {
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
		$data['speakers'] = $this->speaker_model->get_speaker($institute_id,$type);
		$data['subview'] = "speakers/speakers";
		$this->load->view('institute/theme',$data);
	}
	
	public function add(){
		if($this->uri->segment(4)){
			$data['speaker'] = $this->speaker_model->get_speaker_byid($this->uri->segment(4));
		}else{
			$data['speaker'] = "";
		}

		$data['subview'] = "speakers/add_speaker";
		$this->load->view('institute/theme',$data);
	}
	public function bulk(){

		$data['subview'] = "speakers/bulk";
		$this->load->view('institute/theme',$data);
	}


	public function save_speaker(){

		$data = array(
			"speaker_name" => $this->input->post("name"),
			"speaker_designation" => $this->input->post("designation"),
			"speaker_qualification" => $this->input->post("qualification"),
			"speaker_expertise" => $this->input->post("expertise"),
			"speaker_shortdesc" => $this->input->post("shortdesc"),
			"speaker_longdesc" => $this->input->post("longdesc"),
			"speaker_gender" => $this->input->post("gender"),
			"speaker_email" => $this->input->post("email"),
			"speaker_mobile" => $this->input->post("phone"),
			"speaker_status" => $this->input->post("status"),
			"institute_id"	=>$this->session->userdata['institute_id'],
			"login_type" => $this->session->userdata['login_type']
		);

		if($this->uri->segment(4)){
			$data['password'] = $this->institute_login_model->api_key_crypt( $this->input->post("password"),'e');
			$old_password = $this->input->post("old_password");

			if($data['password']!=$old_password){

				$msg = '<html><body>Your password has been updated, please login with below details. <br><small>User ID : '.$data["speaker_email"].'</small><br> <small>Password : '.$this->institute_login_model->api_key_crypt($data["password"],"d").'</small></body></html>';
				$from = "$this->admin_email";
				$subject = "Login Details : KAB Education Fair";
				$to = $data['speaker_email'];
				$re = $this->login_model->sendMail($from,$to,$subject,$msg);
			}
			$this->db->where("speaker_id",$this->input->post("speaker_id"))->update("tbl_speakers",$data); 
			//redirect("institute/speakers");
			$data1=["Status"=>'Active',"Message"=>"Successfully Updated."];
				echo json_encode($data1);
				exit();
		}else{
			$data['password'] = $this->institute_login_model->api_key_crypt(random_string('alnum', 8),"e");
			$check_email = $this->speaker_model->check_email($data['speaker_email']);
			
			if($check_email){
				$query = $this->db->insert("tbl_speakers",$data);
			}else{
				$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">Speaker email already exist.!</div>');
				//redirect("institute/speakers/add");
				$data1=["Status"=>'InActive',"Message"=>"Speaker email already exist."];
			 	echo json_encode($data1);
			 	exit();
			}
			}
			if($query){ 
				$msg = '<html><body><small>User ID : '.$data["speaker_email"].'</small><br> <small>Password : '.$this->institute_login_model->api_key_crypt( $data["password"],"d").'</small></body></html>';
				$from = "$this->admin_email";
				$subject = "Login Details : KAB Education Fair";
				$to = $data['speaker_mobile'];
				$re = $this->login_model->sendMail($from,$to,$subject,$msg);

				//redirect("institute/speakers");
				$data1=["Status"=>'Active',"Message"=>"Successfully Inserted."];
				echo json_encode($data1);
				exit();
			}
			
		}	

	public function delete_speaker(){
		if($this->uri->segment(4)){
			$id =$this->uri->segment(4);
			$query = $this->db->where("speaker_id",$id)->update("tbl_speakers",array('is_deleted' =>'1'));
			if($query){ redirect("institute/speakers");}
		}
	}

}
