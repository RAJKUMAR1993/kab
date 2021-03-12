<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller{
	public function __construct()
	    {
	        parent::__construct();
	        if($this->session->userdata['login_type']!='student'){redirect('student/login');}
	    }

	public function index()
	{
		$stdid = $this->session->userdata['student_id'];
		$data['upcomingcounsellors'] = $this->db->where(["student_id"=>$stdid,"exp_std_time >"=>strtotime(date("Y-m-d H:i:s"))])->get("tbl_expert_student_schedule")->num_rows();
		$data['upcomingpromeetings'] = $this->db->where(["session_student_id"=>$stdid,"session_time >"=>strtotime(date("Y-m-d H:i:s"))])->get("tbl_professor_meeting")->num_rows();
		$data['upcomingpresentations'] = $this->db->where(["student_id"=>$stdid,"from_time >"=>strtotime(date("Y-m-d H:i:s"))])->get("tbl_student_auditorium_presentations")->num_rows();
		$data['enquiriesreplied'] = $this->db->where(["student_id"=>$stdid,"status"=>"Replied"])->get("tbl_institute_ask_a_question")->num_rows();
		$data['applications'] = $this->db->query("SELECT tbl_institute_admission.*,tbl_courses.* FROM tbl_institute_admission LEFT JOIN tbl_courses ON tbl_institute_admission.course_id = tbl_courses.course_id WHERE tbl_institute_admission.student_id='".$stdid."' GROUP BY tbl_institute_admission.institute_id ORDER BY id DESC")->num_rows();
		$data['event_bag'] = $this->db->get("tbl_brouchers")->num_rows();
		
		$data['subview'] = "dashboard/dashboard";
		$this->load->view('student/theme',$data);
	}

	public function college_connect()
	{
		$stdid = $this->session->userdata['student_id'];
		$data['collegeconnect'] = $this->db->where("student_id",$stdid)->get("tbl_exhibitors_students_videos_list")->row();
		$data['subview'] = "wishlist/wishlist";
		$this->load->view('student/theme',$data);
	}
	public function event_bag()
	{
		$data['brouchers'] = $this->db->query("SELECT tbl_brouchers.*,tbl_institutes.institute_name FROM tbl_brouchers LEFT JOIN tbl_institutes ON tbl_brouchers.institute_id = tbl_institutes.institute_id ;")->result();
		$data['subview'] = "dashboard/event_bag";
		$this->load->view('student/theme',$data);
	}
}
