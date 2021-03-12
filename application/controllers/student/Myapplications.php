<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Myapplications extends CI_Controller{
	public function __construct()
	    {
	        parent::__construct();
	        if($this->session->userdata['login_type']!='student'){redirect('student/login');}
	    }

	
	public function admissions()
	{
		
		$data['details'] = $this->db->query("SELECT tbl_institute_admission.*,tbl_courses.* FROM tbl_institute_admission LEFT JOIN tbl_courses ON tbl_institute_admission.course_id = tbl_courses.course_id WHERE tbl_institute_admission.student_id='".$this->session->userdata['student_id']."' GROUP BY tbl_institute_admission.institute_id ORDER BY id DESC")->result();
		$data['subview'] = "myapplications/admissions";
		$this->load->view('student/theme',$data);
	}
    function detail_view($id){
		$data['details'] = $this->db->query("SELECT tbl_institute_admission.*,tbl_courses.* FROM tbl_institute_admission LEFT JOIN tbl_courses ON tbl_institute_admission.course_id = tbl_courses.course_id WHERE tbl_institute_admission.student_id='".$this->session->userdata['student_id']."' AND tbl_institute_admission.institute_id='".$id."'")->result();
		//echo '<pre>';print_r($data);exit;
		$data['subview'] = "myapplications/admission_detail_view";
		$this->load->view('student/theme',$data);
		
	}
	
	
}
