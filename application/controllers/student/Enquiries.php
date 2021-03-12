<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Enquiries extends CI_Controller{
	public function __construct()
	    {
	        parent::__construct();
	        if($this->session->userdata['login_type']!='student'){redirect('student/login');}
	    }

	
	public function index()
	{
		$ref = $this->input->get("status");
		
		$status = "";
		$ctime = strtotime(date("Y-m-d H:i:s"));
			
		if($ref == "Replied"){
			
			$status = "and status='Replied'";
			
		}
		
		$data['details'] = $this->db->query("SELECT * FROM tbl_institute_ask_a_question  WHERE student_id='".$this->session->userdata['student_id']."' $status ORDER BY id DESC")->result();
		$data['subview'] = "enquiries/enquiries";
		$this->load->view('student/theme',$data);
	}

	
	
}
