<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		//$this->load->library('excel');
	        if($this->session->userdata['login_type']!='speaker'){redirect('speaker/login');}
	}

	
	public function index()
	{
		$institute_id =$this->session->userdata['institute_id'];
		$data['tsessions'] = $this->db->where("speaker_id",$this->session->userdata['speaker_id'])->where("is_deleted",'0')->get("tbl_speaker_sessions")->num_rows();
		
		$data['tcsessions'] = $this->db->where("speaker_id",$this->session->userdata['speaker_id'])->where("is_deleted",'0')->where(["(spe_se_time+(duration*60)) <"=>strtotime(date("Y-m-d H:i:s"))])->get("tbl_speaker_sessions")->num_rows();
		
		$data['tbsessions'] = $this->db->where("speaker_id",$this->session->userdata['speaker_id'])->where("is_deleted",'0')->where(["spe_se_time >"=>strtotime(date("Y-m-d H:i:s"))])->get("tbl_speaker_sessions")->num_rows();
		
		$data['tmeetings'] = $this->db->query("SELECT * FROM tbl_speaker_student_schedule LEFT JOIN tbl_students ON tbl_speaker_student_schedule.student_id = tbl_students.student_id WHERE tbl_speaker_student_schedule.speaker_id='".$this->session->userdata['speaker_id']."' ORDER BY spe_std_date DESC ")->num_rows();
		
		$data['eenquiries'] = $this->db->query("SELECT tbl_institute_ask_a_question.*,tbl_students.student_name,tbl_students.email,tbl_students.phone FROM tbl_institute_ask_a_question LEFT JOIN tbl_students ON tbl_institute_ask_a_question.student_id = tbl_students.student_id WHERE tbl_institute_ask_a_question.institute_id='".$this->session->userdata['speaker_id']."' AND tbl_institute_ask_a_question.type='speaker'  ORDER BY id DESC")->num_rows();
		
		$data['penquiries'] = $this->db->query("SELECT tbl_institute_ask_a_question.*,tbl_students.student_name,tbl_students.email,tbl_students.phone FROM tbl_institute_ask_a_question LEFT JOIN tbl_students ON tbl_institute_ask_a_question.student_id = tbl_students.student_id WHERE tbl_institute_ask_a_question.institute_id='".$this->session->userdata['speaker_id']."' AND tbl_institute_ask_a_question.type='speaker' AND tbl_institute_ask_a_question.status='Pending' ORDER BY id DESC")->num_rows();
		
		$data['renquiries'] = $this->db->query("SELECT tbl_institute_ask_a_question.*,tbl_students.student_name,tbl_students.email,tbl_students.phone FROM tbl_institute_ask_a_question LEFT JOIN tbl_students ON tbl_institute_ask_a_question.student_id = tbl_students.student_id WHERE tbl_institute_ask_a_question.institute_id='".$this->session->userdata['speaker_id']."' AND tbl_institute_ask_a_question.type='speaker' AND tbl_institute_ask_a_question.status='Replied' ORDER BY id DESC")->num_rows();
		
		$data['subview'] = "reports/reports";		
		$this->load->view('speaker/theme',$data);
	}
	
	public function sessions_completed()
	{
		$institute_id =$this->session->userdata['institute_id'];
		
		$data['sessions'] = $this->db->where("speaker_id",$this->session->userdata['speaker_id'])->where("is_deleted",'0')->where(["(spe_se_time+(duration*60)) <"=>strtotime(date("Y-m-d H:i:s"))])->get("tbl_speaker_sessions")->result();
		
		$data['subview'] = "reports/sessions";		
		$this->load->view('speaker/theme',$data);
	}
	
	public function sessions_tobecompleted()
	{
		
		$data['sessions'] = $this->db->where("speaker_id",$this->session->userdata['speaker_id'])->where("is_deleted",'0')->where(["spe_se_time >"=>strtotime(date("Y-m-d H:i:s"))])->get("tbl_speaker_sessions")->result();
		
		$data['subview'] = "reports/sessions";		
		$this->load->view('speaker/theme',$data);
	}

	public function sessions_not_completed()
	{
		$data['sessions'] = $this->db->where("speaker_id",$this->session->userdata['speaker_id'])->where(["spe_se_time >"=>strtotime(date("Y-m-d H:i:s"))])->get("tbl_speaker_sessions")->result();
	     echo $this->db->last_query();die;
		$data['subview'] = "reports/sessions";		
		$this->load->view('speaker/theme',$data);
	}



	public function enquiries_replied()
	{
		
		$data['details'] = $this->db->query("SELECT tbl_institute_ask_a_question.*,tbl_students.student_name,tbl_students.email,tbl_students.phone FROM tbl_institute_ask_a_question LEFT JOIN tbl_students ON tbl_institute_ask_a_question.student_id = tbl_students.student_id WHERE tbl_institute_ask_a_question.institute_id='".$this->session->userdata['speaker_id']."' AND tbl_institute_ask_a_question.type='speaker' AND tbl_institute_ask_a_question.status='Replied' ORDER BY id DESC")->result();
		
		$data['subview'] = "reports/enquiries";		
		$this->load->view('speaker/theme',$data);
	}
	
	public function enquiries_pending()
	{
		
		$data['details'] = $this->db->query("SELECT tbl_institute_ask_a_question.*,tbl_students.student_name,tbl_students.email,tbl_students.phone FROM tbl_institute_ask_a_question LEFT JOIN tbl_students ON tbl_institute_ask_a_question.student_id = tbl_students.student_id WHERE tbl_institute_ask_a_question.institute_id='".$this->session->userdata['speaker_id']."' AND tbl_institute_ask_a_question.type='speaker' AND tbl_institute_ask_a_question.status='Pending' ORDER BY id DESC")->result();
		$data['subview'] = "reports/enquiries";		
		$this->load->view('speaker/theme',$data);
	}

}
