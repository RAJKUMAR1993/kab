<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');

class Speakers extends CI_Controller {
	
	public function __construct(){
	        parent::__construct();
	        if($this->session->userdata['login_type']!='admin'){redirect('admin');}
			
			$this->admin_email = $this->login_model->get_option("admin_email_id")->email;
	}

	public function index()
	{
		$institute_id =$this->session->userdata['admin_id'];
		$type =$this->session->userdata['login_type'];
		$data['speakers'] = $this->db->order_by("speaker_id","desc")->get_where("tbl_speakers",["is_deleted"=>0])->result();
		// /echo "<pre>";print_r($data['speakers']);die();
		$data['subview'] = "speakers/speakers";
		$this->load->view('admin/theme',$data);
	}
	public function active_status(){
		$speaker_status = $this->input->get("speaker_status");
		if($speaker_status){
			$this->db->where("speaker_status",$speaker_status);
		}
		$data['speakers'] = $this->db->order_by("speaker_id","desc")->get_where("tbl_speakers",["speaker_status"=>"Active","is_deleted"=>0])->result();

		$data['subview'] = "speakers/speakers";
		$this->load->view('admin/theme',$data);
	}
	public function inactive_status(){
		$speaker_status = $this->input->get("speaker_status");
		if($speaker_status){
			$this->db->where("speaker_status",$speaker_status);
		}
		$data['speakers'] = $this->db->order_by("speaker_id","desc")->get_where("tbl_speakers",["speaker_status"=>"inactive","is_deleted"=>0])->result();
		$data['subview'] = "speakers/speakers";
		$this->load->view('admin/theme',$data);
	}
	public function add(){
		if($this->uri->segment(4)){
			$data['speaker'] = $this->speaker_model->get_speaker_byid($this->uri->segment(4));
		}else{
			$data['speaker'] = "";
		}

		$data['subview'] = "speakers/add_speaker";
		$this->load->view('admin/theme',$data);
	}
	public function bulk(){

		$data['subview'] = "speakers/bulk";
		$this->load->view('admin/theme',$data);
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
			"institute_id"	=>$this->session->userdata['admin_id'],
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
			//redirect("admin/speakers");
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
				//redirect("admin/speakers/add");
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

				//redirect("admin/speakers");
				$data1=["Status"=>'Active',"Message"=>"Successfully Inserted."];
				echo json_encode($data1);
				exit();
			}
			
		}	

	public function delete_speaker(){
		if($this->uri->segment(4)){
			$id =$this->uri->segment(4);
			$query = $this->db->where("speaker_id",$id)->update("tbl_speakers",array('is_deleted' =>'1'));
			if($query){ redirect("admin/speakers");}
		}
	}
	public function meetings()
	{
		$data['meetings'] = $this->db->query("SELECT * FROM tbl_speaker_student_schedule LEFT JOIN tbl_students ON tbl_speaker_student_schedule.student_id = tbl_students.student_id WHERE tbl_speaker_student_schedule.speaker_id='".$this->uri->segment(4)."' ORDER BY spe_std_date DESC")->result();
		$data['subview'] = "speakers/spe_meetings";
		$this->load->view('admin/theme',$data);
	}

}
