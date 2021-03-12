<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		//$this->load->library('excel');
	        if($this->session->userdata['login_type']!='counsellor'){redirect('counsellor/login');}
	}

	
	public function index()
	{
		$data['tsessions'] = $this->db->where("expert_id",$this->session->userdata['expert_id'])->where("is_deleted",'0')->get("tbl_counsellor_sessions")->num_rows();
		
		$data['tcsessions'] = $this->db->where("expert_id",$this->session->userdata['expert_id'])->where("is_deleted",'0')->where(["(exp_se_time+(duration*60)) <"=>strtotime(date("Y-m-d H:i:s"))])->get("tbl_counsellor_sessions")->num_rows();
		
		$data['tbsessions'] = $this->db->where("expert_id",$this->session->userdata['expert_id'])->where("is_deleted",'0')->where(["exp_se_time >"=>strtotime(date("Y-m-d H:i:s"))])->get("tbl_counsellor_sessions")->num_rows();
		
		$data['tmeetings'] = $this->db->where("expert_id",$this->session->userdata['expert_id'])->where("is_deleted",'0')->where("is_booked","Active")->get("tbl_counsellor_sessions")->num_rows();
		
		$data['tnameetings'] = $this->db->where("expert_id",$this->session->userdata['expert_id'])->where("is_deleted",'0')->where("is_booked","Inactive")->get("tbl_counsellor_sessions")->num_rows();
		
		$data['eenquiries'] = $this->db->query("SELECT tbl_institute_ask_a_question.*,tbl_students.student_name,tbl_students.email,tbl_students.phone FROM tbl_institute_ask_a_question LEFT JOIN tbl_students ON tbl_institute_ask_a_question.student_id = tbl_students.student_id WHERE tbl_institute_ask_a_question.institute_id='".$this->session->userdata['expert_id']."' AND tbl_institute_ask_a_question.type='counsellor'  ORDER BY id DESC")->num_rows();
		
		$data['penquiries'] = $this->db->query("SELECT tbl_institute_ask_a_question.*,tbl_students.student_name,tbl_students.email,tbl_students.phone FROM tbl_institute_ask_a_question LEFT JOIN tbl_students ON tbl_institute_ask_a_question.student_id = tbl_students.student_id WHERE tbl_institute_ask_a_question.institute_id='".$this->session->userdata['expert_id']."' AND tbl_institute_ask_a_question.type='counsellor' AND tbl_institute_ask_a_question.status='Pending' ORDER BY id DESC")->num_rows();
		
		$data['renquiries'] = $this->db->query("SELECT tbl_institute_ask_a_question.*,tbl_students.student_name,tbl_students.email,tbl_students.phone FROM tbl_institute_ask_a_question LEFT JOIN tbl_students ON tbl_institute_ask_a_question.student_id = tbl_students.student_id WHERE tbl_institute_ask_a_question.institute_id='".$this->session->userdata['expert_id']."' AND tbl_institute_ask_a_question.type='counsellor' AND tbl_institute_ask_a_question.status='Replied' ORDER BY id DESC")->num_rows();
		
		$data['subview'] = "reports/reports";		
		$this->load->view('counsellor/theme',$data);
	}
	
	public function sessions_completed()
	{		
		$data['sessions'] = $this->db->where("expert_id",$this->session->userdata['expert_id'])->where("is_deleted",'0')->where(["(exp_se_time+(duration*60)) <"=>strtotime(date("Y-m-d H:i:s"))])->get("tbl_counsellor_sessions")->result();
		
		$data['subview'] = "reports/sessions";		
		$this->load->view('counsellor/theme',$data);
	}
	
	public function sessions_tobecompleted()
	{
		
		$data['sessions'] = $this->db->where("expert_id",$this->session->userdata['expert_id'])->where("is_deleted",'0')->where(["exp_se_time >"=>strtotime(date("Y-m-d H:i:s"))])->get("tbl_counsellor_sessions")->result();
		
		$data['subview'] = "reports/sessions";		
		$this->load->view('counsellor/theme',$data);
	}
	
	public function sessions_na()
	{
		
		$data['sessions'] = $this->db->where("expert_id",$this->session->userdata['expert_id'])->where("is_deleted",'0')->where("is_booked","Inactive")->get("tbl_counsellor_sessions")->result();
		
		$data['subview'] = "reports/sessions";		
		$this->load->view('counsellor/theme',$data);
	}
	
	public function enquiries_replied()
	{
		
		$data['details'] = $this->db->query("SELECT tbl_institute_ask_a_question.*,tbl_students.student_name,tbl_students.email,tbl_students.phone FROM tbl_institute_ask_a_question LEFT JOIN tbl_students ON tbl_institute_ask_a_question.student_id = tbl_students.student_id WHERE tbl_institute_ask_a_question.institute_id='".$this->session->userdata['expert_id']."' AND tbl_institute_ask_a_question.type='counsellor' AND tbl_institute_ask_a_question.status='Replied' ORDER BY id DESC")->result();
		
		$data['subview'] = "reports/enquiries";		
		$this->load->view('counsellor/theme',$data);
	}
	
	public function enquiries_pending()
	{
		
		$data['details'] = $this->db->query("SELECT tbl_institute_ask_a_question.*,tbl_students.student_name,tbl_students.email,tbl_students.phone FROM tbl_institute_ask_a_question LEFT JOIN tbl_students ON tbl_institute_ask_a_question.student_id = tbl_students.student_id WHERE tbl_institute_ask_a_question.institute_id='".$this->session->userdata['expert_id']."' AND tbl_institute_ask_a_question.type='counsellor' AND tbl_institute_ask_a_question.status='Pending' ORDER BY id DESC")->result();
		
		$data['subview'] = "reports/enquiries";		
		$this->load->view('counsellor/theme',$data);
	}
	
}
