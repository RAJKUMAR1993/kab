<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');
class Enquiries extends CI_Controller{
	public function __construct()
	    {
	        parent::__construct();
	        if($this->session->userdata['login_type']!='expert'){redirect('expert/login');}
	    }

	
	public function index()
	{
		
		$data['details'] = $this->db->query("SELECT tbl_institute_ask_a_question.*,tbl_students.student_name,tbl_students.email,tbl_students.phone FROM tbl_institute_ask_a_question LEFT JOIN tbl_students ON tbl_institute_ask_a_question.student_id = tbl_students.student_id WHERE tbl_institute_ask_a_question.institute_id='".$this->session->userdata['expert_id']."' AND tbl_institute_ask_a_question.type='expert'  ORDER BY id DESC")->result();
		
		$data['subview'] = "enquiries/enquiries";
		$this->load->view('expert/theme',$data);
	}


	public function updateenquiry(){
		$csid = $this->input->post('csid');	
		$data = array(
			"message" =>$this->input->post("message"),
			"status" =>"Replied",
			"message_date" =>date("Y-m-d")
		);

			$d = $this->db->where("id",$csid)->update("tbl_institute_ask_a_question",$data);
			
			if($d){
				
				echo "success";
				
			}else{
				
				echo "error";
				
			}
	}

	
	
}
