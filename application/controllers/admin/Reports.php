<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		//$this->load->library('excel');
		
	        if($this->session->userdata['login_type']!='admin'){redirect('admin');}
	}

	public function index()
	{
		
		$data['subview'] = "reports/mainreports";		
		$this->load->view('admin/theme',$data);
	}
	
	public function expert_reports()
	{
		$data['tsessions'] = $this->db->where("is_deleted",'0')->get("tbl_expert_sessions")->num_rows();
		
		$data['tcsessions'] = $this->db->where("is_deleted",'0')->where(["(exp_se_time+(duration*60)) <"=>strtotime(date("Y-m-d H:i:s"))])->get("tbl_expert_sessions")->num_rows();
		
		$data['tbsessions'] = $this->db->where("is_deleted",'0')->where(["exp_se_time >"=>strtotime(date("Y-m-d H:i:s"))])->get("tbl_expert_sessions")->num_rows();
		
		$data['tmeetings'] = $this->db->query("SELECT * FROM tbl_expert_student_schedule LEFT JOIN tbl_students ON tbl_expert_student_schedule.student_id = tbl_students.student_id ORDER BY exp_std_date DESC ")->num_rows();
		
		$data['eenquiries'] = $this->db->query("SELECT tbl_institute_ask_a_question.*,tbl_students.student_name,tbl_students.email,tbl_students.phone FROM tbl_institute_ask_a_question LEFT JOIN tbl_students ON tbl_institute_ask_a_question.student_id = tbl_students.student_id WHERE tbl_institute_ask_a_question.type='expert'  ORDER BY id DESC")->num_rows();
		
		$data['penquiries'] = $this->db->query("SELECT tbl_institute_ask_a_question.*,tbl_students.student_name,tbl_students.email,tbl_students.phone FROM tbl_institute_ask_a_question LEFT JOIN tbl_students ON tbl_institute_ask_a_question.student_id = tbl_students.student_id WHERE tbl_institute_ask_a_question.type='expert' AND tbl_institute_ask_a_question.status='Pending' ORDER BY id DESC")->num_rows();
		
		$data['renquiries'] = $this->db->query("SELECT tbl_institute_ask_a_question.*,tbl_students.student_name,tbl_students.email,tbl_students.phone FROM tbl_institute_ask_a_question LEFT JOIN tbl_students ON tbl_institute_ask_a_question.student_id = tbl_students.student_id WHERE  tbl_institute_ask_a_question.type='expert' AND tbl_institute_ask_a_question.status='Replied' ORDER BY id DESC")->num_rows();
		
		$data['subview'] = "reports/expert/reports";		
		$this->load->view('admin/theme',$data);
	}
	public function speaker_reports()
	{
		$data['tsessions'] = $this->db->where("is_deleted",'0')->get("tbl_speaker_sessions")->num_rows();
		
		$data['tcsessions'] = $this->db->where("is_deleted",'0')->where(["(spe_se_time+(duration*60)) <"=>strtotime(date("Y-m-d H:i:s"))])->get("tbl_speaker_sessions")->num_rows();
		
		$data['tbsessions'] = $this->db->where("is_deleted",'0')->where(["spe_se_time >"=>strtotime(date("Y-m-d H:i:s"))])->get("tbl_speaker_sessions")->num_rows();
		
		$data['tmeetings'] = $this->db->query("SELECT * FROM tbl_speaker_student_schedule LEFT JOIN tbl_students ON tbl_speaker_student_schedule.student_id = tbl_students.student_id ORDER BY spe_std_date DESC ")->num_rows();
		
		$data['eenquiries'] = $this->db->query("SELECT tbl_institute_ask_a_question.*,tbl_students.student_name,tbl_students.email,tbl_students.phone FROM tbl_institute_ask_a_question LEFT JOIN tbl_students ON tbl_institute_ask_a_question.student_id = tbl_students.student_id WHERE tbl_institute_ask_a_question.type='speaker'  ORDER BY id DESC")->num_rows();
		
		$data['penquiries'] = $this->db->query("SELECT tbl_institute_ask_a_question.*,tbl_students.student_name,tbl_students.email,tbl_students.phone FROM tbl_institute_ask_a_question LEFT JOIN tbl_students ON tbl_institute_ask_a_question.student_id = tbl_students.student_id WHERE tbl_institute_ask_a_question.type='speaker' AND tbl_institute_ask_a_question.status='Pending' ORDER BY id DESC")->num_rows();
		
		$data['renquiries'] = $this->db->query("SELECT tbl_institute_ask_a_question.*,tbl_students.student_name,tbl_students.email,tbl_students.phone FROM tbl_institute_ask_a_question LEFT JOIN tbl_students ON tbl_institute_ask_a_question.student_id = tbl_students.student_id WHERE  tbl_institute_ask_a_question.type='speaker' AND tbl_institute_ask_a_question.status='Replied' ORDER BY id DESC")->num_rows();
		
		$data['subview'] = "reports/speaker/reports";		
		$this->load->view('admin/theme',$data);
	}
	
	public function total_sessions()
	{	
		$expert = $this->input->post("expert");
		if($expert){
			$this->db->where("expert_id",$expert);
		}
		$data['sessions'] = $this->db->where("is_deleted",'0')->get("tbl_expert_sessions")->result();
		$data['subview'] = "reports/expert/sessions";		
		$this->load->view('admin/theme',$data);
	}

	
	public function total_speaker_sessions()
	{		
		$speaker = $this->input->post("speaker");
		if($speaker){
			$this->db->where("speaker_id",$speaker);
		}
		$data['sessions'] = $this->db->where("is_deleted",'0')->get("tbl_speaker_sessions")->result();		
		$data['subview'] = "reports/speaker/sessions";		
		$this->load->view('admin/theme',$data);
	}
	
	public function total_meetings()
	{
		
		$data['meetings'] = $this->db->query("SELECT * FROM tbl_expert_student_schedule LEFT JOIN tbl_students ON tbl_expert_student_schedule.student_id = tbl_students.student_id ORDER BY exp_std_date DESC ")->result();		
		$data['subview'] = "reports/expert/meetings";		
		$this->load->view('admin/theme',$data);
	}
	public function total_speaker_meetings()
	{
		
		$data['meetings'] = $this->db->query("SELECT * FROM tbl_speaker_student_schedule LEFT JOIN tbl_students ON tbl_speaker_student_schedule.student_id = tbl_students.student_id ORDER BY spe_std_date DESC ")->result();		

		$data['subview'] = "reports/speaker/meetings";		
		$this->load->view('admin/theme',$data);
	}
	
	public function sessions_completed()
	{
		$expert = $this->input->post("expert");
		if($expert){
			$this->db->where("expert_id",$expert);
		}
		$data['sessions'] = $this->db->where("is_deleted",'0')->where(["(exp_se_time+(duration*60)) <"=>strtotime(date("Y-m-d H:i:s"))])->get("tbl_expert_sessions")->result();		
		$data['subview'] = "reports/expert/sessions";		
		$this->load->view('admin/theme',$data);
	}
	public function sessions_speaker_completed()
	{
		$speaker = $this->input->post("speaker");
		if($speaker){
			$this->db->where("speaker_id",$speaker);
		}
		$data['sessions'] = $this->db->where("is_deleted",'0')->where(["(spe_se_time+(duration*60)) <"=>strtotime(date("Y-m-d H:i:s"))])->get("tbl_speaker_sessions")->result();		
		$data['subview'] = "reports/speaker/sessions";		
		$this->load->view('admin/theme',$data);
	}
	
	public function sessions_tobecompleted()
	{
		$expert = $this->input->post("expert");
		if($expert){
			$this->db->where("expert_id",$expert);
		}
		$data['sessions'] = $this->db->where("is_deleted",'0')->where(["exp_se_time >"=>strtotime(date("Y-m-d H:i:s"))])->get("tbl_expert_sessions")->result();		
		$data['subview'] = "reports/expert/sessions";		
		$this->load->view('admin/theme',$data);
	}
	public function sessions_speaker_tobecompleted()
	{
		$speaker = $this->input->post("speaker");
		if($speaker){
			$this->db->where("speaker_id",$speaker);
		}
		$data['sessions'] = $this->db->where("is_deleted",'0')->where(["spe_se_time >"=>strtotime(date("Y-m-d H:i:s"))])->get("tbl_speaker_sessions")->result();		
		
		$data['subview'] = "reports/speaker/sessions";		
		$this->load->view('admin/theme',$data);
	}
	
	public function enquiries()
	{
		if($this->input->post("expert")){
			$id = $this->input->post("expert");
			$expert = "and tbl_institute_ask_a_question.institute_id = $id";
		}else{
			$expert = "";		
		}
		$data['details'] = $this->db->query("SELECT tbl_institute_ask_a_question.*,tbl_students.student_name,tbl_students.email,tbl_students.phone FROM tbl_institute_ask_a_question LEFT JOIN tbl_students ON tbl_institute_ask_a_question.student_id = tbl_students.student_id WHERE tbl_institute_ask_a_question.type='expert' $expert ORDER BY id DESC")->result();
		$data['subview'] = "reports/expert/enquiries";		
		$this->load->view('admin/theme',$data);
	}
	public function enquiries_speaker()
	{
		if($this->input->post("expert")){
			$id = $this->input->post("expert");
			$speaker = "and tbl_institute_ask_a_question.institute_id = $id";
		}else{
			$speaker = "";		
		}
		
		$data['details'] = $this->db->query("SELECT tbl_institute_ask_a_question.*,tbl_students.student_name,tbl_students.email,tbl_students.phone FROM tbl_institute_ask_a_question LEFT JOIN tbl_students ON tbl_institute_ask_a_question.student_id = tbl_students.student_id WHERE tbl_institute_ask_a_question.type='speaker' $speaker ORDER BY id DESC")->result();

		$data['subview'] = "reports/speaker/enquiries";		
		$this->load->view('admin/theme',$data);
	}
	
	public function enquiries_replied()
	{
		if($this->input->post("expert")){
			$id = $this->input->post("expert");
			$expert = "and tbl_institute_ask_a_question.institute_id = $id";
		}else{
			$expert = "";		
		}
		$data['details'] = $this->db->query("SELECT tbl_institute_ask_a_question.*,tbl_students.student_name,tbl_students.email,tbl_students.phone FROM tbl_institute_ask_a_question LEFT JOIN tbl_students ON tbl_institute_ask_a_question.student_id = tbl_students.student_id WHERE tbl_institute_ask_a_question.type='expert' AND tbl_institute_ask_a_question.status='Replied' $expert ORDER BY id DESC")->result();
		$data['subview'] = "reports/expert/enquiries";		
		$this->load->view('admin/theme',$data);
	}
	public function enquiries_replied_speaker()
	{
		if($this->input->post("speaker")){
			$id = $this->input->post("speaker");
			$speaker = "and tbl_institute_ask_a_question.institute_id = $id";
		}else{
			$speaker = "";		
		}
		$data['details'] = $this->db->query("SELECT tbl_institute_ask_a_question.*,tbl_students.student_name,tbl_students.email,tbl_students.phone FROM tbl_institute_ask_a_question LEFT JOIN tbl_students ON tbl_institute_ask_a_question.student_id = tbl_students.student_id WHERE tbl_institute_ask_a_question.type='speaker' AND tbl_institute_ask_a_question.status='Replied' $speaker ORDER BY id DESC")->result();
		$data['subview'] = "reports/speaker/enquiries";		
		$this->load->view('admin/theme',$data);
	}
	
	public function enquiries_pending()
	{
		if($this->input->post("expert")){
			$id = $this->input->post("expert");
			$expert = "and tbl_institute_ask_a_question.institute_id = $id";
		}else{
			$expert = "";		
		}
		$data['details'] = $this->db->query("SELECT tbl_institute_ask_a_question.*,tbl_students.student_name,tbl_students.email,tbl_students.phone FROM tbl_institute_ask_a_question LEFT JOIN tbl_students ON tbl_institute_ask_a_question.student_id = tbl_students.student_id WHERE tbl_institute_ask_a_question.type='expert' AND tbl_institute_ask_a_question.status='Pending' $expert ORDER BY id DESC")->result();		
		$data['subview'] = "reports/expert/enquiries";		
		$this->load->view('admin/theme',$data);
	}
	public function enquiries_pending_speaker()
	{
		if($this->input->post("expert")){
			$id = $this->input->post("expert");
			$speaker = "and tbl_institute_ask_a_question.institute_id = $id";
		}else{
			$speaker = "";		
		}
		
		$data['details'] = $this->db->query("SELECT tbl_institute_ask_a_question.*,tbl_students.student_name,tbl_students.email,tbl_students.phone FROM tbl_institute_ask_a_question LEFT JOIN tbl_students ON tbl_institute_ask_a_question.student_id = tbl_students.student_id WHERE tbl_institute_ask_a_question.type='speaker' AND tbl_institute_ask_a_question.status='Pending' $speaker ORDER BY id DESC")->result();		
		$data['subview'] = "reports/speaker/enquiries";		
		$this->load->view('admin/theme',$data);
	}
	public function professor_reports()
	{
		$data['tsessions'] = $this->db->where("is_deleted",'0')->get("tbl_professor_sessions")->num_rows();
		
		$data['tcsessions'] = $this->db->where("is_deleted",'0')->where(["(pro_se_time+(duration*60)) <"=>strtotime(date("Y-m-d H:i:s"))])->get("tbl_professor_sessions")->num_rows();
		
		$data['tbsessions'] = $this->db->where("is_deleted",'0')->where(["pro_se_time >"=>strtotime(date("Y-m-d H:i:s"))])->get("tbl_professor_sessions")->num_rows();
		
		$data['tmeetings'] = $this->db->query("SELECT * FROM tbl_professor_meeting LEFT JOIN tbl_students ON tbl_professor_meeting.session_student_id = tbl_students.student_id ORDER BY session_date DESC ")->num_rows();
		
		$data['eenquiries'] = $this->db->query("SELECT tbl_institute_ask_a_question.*,tbl_students.student_name,tbl_students.email,tbl_students.phone FROM tbl_institute_ask_a_question LEFT JOIN tbl_students ON tbl_institute_ask_a_question.student_id = tbl_students.student_id WHERE tbl_institute_ask_a_question.type='professor'  ORDER BY id DESC")->num_rows();
		
		$data['penquiries'] = $this->db->query("SELECT tbl_institute_ask_a_question.*,tbl_students.student_name,tbl_students.email,tbl_students.phone FROM tbl_institute_ask_a_question LEFT JOIN tbl_students ON tbl_institute_ask_a_question.student_id = tbl_students.student_id WHERE tbl_institute_ask_a_question.type='professor' AND tbl_institute_ask_a_question.status='Pending' ORDER BY id DESC")->num_rows();
		
		$data['renquiries'] = $this->db->query("SELECT tbl_institute_ask_a_question.*,tbl_students.student_name,tbl_students.email,tbl_students.phone FROM tbl_institute_ask_a_question LEFT JOIN tbl_students ON tbl_institute_ask_a_question.student_id = tbl_students.student_id WHERE  tbl_institute_ask_a_question.type='professor' AND tbl_institute_ask_a_question.status='Replied' ORDER BY id DESC")->num_rows();
		
		$data['subview'] = "reports/professor/reports";		
		$this->load->view('admin/theme',$data);
	}

	public function total_professor_sessions()
	{		$professor = $this->input->post("professor");
		if($professor){
			$this->db->where("professor_id",$professor);
		}
		$data['sessions'] = $this->db->where("is_deleted",'0')->get("tbl_professor_sessions")->result();		
		$data['subview'] = "reports/professor/sessions";		
		$this->load->view('admin/theme',$data);
	}

	public function total_professor_meetings()
	{
		
		$data['meetings'] = $this->db->query("SELECT * FROM tbl_professor_meeting LEFT JOIN tbl_students ON tbl_professor_meeting.session_student_id = tbl_students.student_id ORDER BY session_date DESC ")->result();		
		$data['subview'] = "reports/professor/meetings";		
		$this->load->view('admin/theme',$data);
	}
	
	public function sessions_professor_completed()
	{
		$professor = $this->input->post("professor");
		if($professor){
			$this->db->where("professor_id",$professor);
		}
		$data['sessions'] = $this->db->where("is_deleted",'0')->where(["(pro_se_time+(duration*60)) <"=>strtotime(date("Y-m-d H:i:s"))])->get("tbl_professor_sessions")->result();		
		$data['subview'] = "reports/professor/sessions";		
		$this->load->view('admin/theme',$data);
	}

	public function sessions_professor_tobecompleted()
	{
		
	$professor = $this->input->post("professor");
		if($professor){
			$this->db->where("professor_id",$professor);
		}
		$data['sessions'] = $this->db->where("is_deleted",'0')->where(["pro_se_time >"=>strtotime(date("Y-m-d H:i:s"))])->get("tbl_professor_sessions")->result();		
		$data['subview'] = "reports/professor/sessions";		
		$this->load->view('admin/theme',$data);
	}

	public function enquiries_professor()
	{
		if($this->input->post("professor")){
			$id = $this->input->post("professor");
			$professor = "and tbl_institute_ask_a_question.institute_id = $id";
		}else{
			$professor = "";		
		} 
		$data['details'] = $this->db->query("SELECT tbl_institute_ask_a_question.*,tbl_students.student_name,tbl_students.email,tbl_students.phone FROM tbl_institute_ask_a_question LEFT JOIN tbl_students ON tbl_institute_ask_a_question.student_id = tbl_students.student_id WHERE tbl_institute_ask_a_question.type='professor' $professor ORDER BY id DESC")->result();
		
		$data['subview'] = "reports/professor/enquiries";		
		$this->load->view('admin/theme',$data);
	}

	public function enquiries_replied_professor()
	{
		if($this->input->post("professor")){
			$id = $this->input->post("professor");
			$professor = "and tbl_institute_ask_a_question.institute_id = $id";
		}else{
			$professor = "";		
		}
		$data['details'] = $this->db->query("SELECT tbl_institute_ask_a_question.*,tbl_students.student_name,tbl_students.email,tbl_students.phone FROM tbl_institute_ask_a_question LEFT JOIN tbl_students ON tbl_institute_ask_a_question.student_id = tbl_students.student_id WHERE tbl_institute_ask_a_question.type='professor' AND tbl_institute_ask_a_question.status='Replied' $professor ORDER BY id DESC")->result();
		$data['subview'] = "reports/professor/enquiries";		
		$this->load->view('admin/theme',$data);
	}

	public function enquiries_pending_professor()
	{
		if($this->input->post("professor")){
			$id = $this->input->post("professor");
			$professor = "and tbl_institute_ask_a_question.institute_id = $id";
		}else{
			$professor = "";		
		}
		$data['details'] = $this->db->query("SELECT tbl_institute_ask_a_question.*,tbl_students.student_name,tbl_students.email,tbl_students.phone FROM tbl_institute_ask_a_question LEFT JOIN tbl_students ON tbl_institute_ask_a_question.student_id = tbl_students.student_id WHERE tbl_institute_ask_a_question.type='professor' AND tbl_institute_ask_a_question.status='Pending' $professor ORDER BY id DESC")->result();		
		$data['subview'] = "reports/professor/enquiries";		
		$this->load->view('admin/theme',$data);
	}
	
	public function counsellor_reports()
	{
		$data['tsessions'] = $this->db->where("is_deleted",'0')->get("tbl_counsellor_sessions")->num_rows();
		
		$data['tcsessions'] = $this->db->where("is_deleted",'0')->where(["(exp_se_time+(duration*60)) <"=>strtotime(date("Y-m-d H:i:s"))])->get("tbl_counsellor_sessions")->num_rows();
		
		$data['tbsessions'] = $this->db->where("is_deleted",'0')->where(["exp_se_time >"=>strtotime(date("Y-m-d H:i:s"))])->get("tbl_counsellor_sessions")->num_rows();
		
		$data['tmeetings'] = $this->db->query("SELECT * FROM tbl_counsellor_student_schedule LEFT JOIN tbl_students ON tbl_counsellor_student_schedule.student_id = tbl_students.student_id ORDER BY exp_std_date DESC ")->num_rows();
		
		$data['eenquiries'] = $this->db->query("SELECT tbl_institute_ask_a_question.*,tbl_students.student_name,tbl_students.email,tbl_students.phone FROM tbl_institute_ask_a_question LEFT JOIN tbl_students ON tbl_institute_ask_a_question.student_id = tbl_students.student_id WHERE tbl_institute_ask_a_question.type='counsellor'  ORDER BY id DESC")->num_rows();
		
		$data['penquiries'] = $this->db->query("SELECT tbl_institute_ask_a_question.*,tbl_students.student_name,tbl_students.email,tbl_students.phone FROM tbl_institute_ask_a_question LEFT JOIN tbl_students ON tbl_institute_ask_a_question.student_id = tbl_students.student_id WHERE tbl_institute_ask_a_question.type='counsellor' AND tbl_institute_ask_a_question.status='Pending' ORDER BY id DESC")->num_rows();
		
		$data['renquiries'] = $this->db->query("SELECT tbl_institute_ask_a_question.*,tbl_students.student_name,tbl_students.email,tbl_students.phone FROM tbl_institute_ask_a_question LEFT JOIN tbl_students ON tbl_institute_ask_a_question.student_id = tbl_students.student_id WHERE  tbl_institute_ask_a_question.type='counsellor' AND tbl_institute_ask_a_question.status='Replied' ORDER BY id DESC")->num_rows();
		
		$data['subview'] = "reports/counsellor/reports";		
		$this->load->view('admin/theme',$data);
	}

	public function total_counsellor_sessions()
	{		
		$expert = $this->input->post("expert");
		if($expert){
			$this->db->where("expert_id",$expert);
		}
		$data['sessions'] = $this->db->where("is_deleted",'0')->get("tbl_counsellor_sessions")->result();		
		$data['subview'] = "reports/counsellor/sessions";		
		$this->load->view('admin/theme',$data);
	}

	public function total_counsellor_meetings()
	{
		
		$data['meetings'] = $this->db->query("SELECT * FROM tbl_counsellor_student_schedule LEFT JOIN tbl_students ON tbl_counsellor_student_schedule.student_id = tbl_students.student_id ORDER BY exp_std_date DESC ")->result();		
		$data['subview'] = "reports/counsellor/meetings";		
		$this->load->view('admin/theme',$data);
	}
	
	public function sessions_counsellor_completed()
	{
		$expert = $this->input->post("expert");
		if($expert){
			$this->db->where("expert_id",$expert);
		}
		$data['sessions'] = $this->db->where("is_deleted",'0')->where(["(exp_se_time+(duration*60)) <"=>strtotime(date("Y-m-d H:i:s"))])->get("tbl_counsellor_sessions")->result();		
		$data['subview'] = "reports/counsellor/sessions";		
		$this->load->view('admin/theme',$data);
	}

	public function sessions_counsellor_tobecompleted()
	{
		$expert = $this->input->post("expert");
		if($expert){
			$this->db->where("expert_id",$expert);
		}
		$data['sessions'] = $this->db->where("is_deleted",'0')->where(["exp_se_time >"=>strtotime(date("Y-m-d H:i:s"))])->get("tbl_counsellor_sessions")->result();		
		$data['subview'] = "reports/counsellor/sessions";		
		$this->load->view('admin/theme',$data);
	}

	public function enquiries_counsellor()
	{
		if($this->input->post("expert")){
			$id = $this->input->post("expert");
			$expert = "and tbl_institute_ask_a_question.institute_id = $id";
		}else{
			$expert = "";		
		}
		$data['details'] = $this->db->query("SELECT tbl_institute_ask_a_question.*,tbl_students.student_name,tbl_students.email,tbl_students.phone FROM tbl_institute_ask_a_question LEFT JOIN tbl_students ON tbl_institute_ask_a_question.student_id = tbl_students.student_id WHERE tbl_institute_ask_a_question.type='counsellor' $expert ORDER BY id DESC")->result();
		$data['subview'] = "reports/counsellor/enquiries";		
		$this->load->view('admin/theme',$data);
	}

	public function enquiries_replied_counsellor()
	{
		if($this->input->post("expert")){
			$id = $this->input->post("expert");
			$expert = "and tbl_institute_ask_a_question.institute_id = $id";
		}else{
			$expert = "";		
		}
		$data['details'] = $this->db->query("SELECT tbl_institute_ask_a_question.*,tbl_students.student_name,tbl_students.email,tbl_students.phone FROM tbl_institute_ask_a_question LEFT JOIN tbl_students ON tbl_institute_ask_a_question.student_id = tbl_students.student_id WHERE tbl_institute_ask_a_question.type='counsellor' AND tbl_institute_ask_a_question.status='Replied' $expert ORDER BY id DESC")->result();
		$data['subview'] = "reports/counsellor/enquiries";		
		$this->load->view('admin/theme',$data);
	}

	public function enquiries_pending_counsellor()
	{
		if($this->input->post("expert")){
			$id = $this->input->post("expert");
			$expert = "and tbl_institute_ask_a_question.institute_id = $id";
		}else{
			$expert = "";		
		}
		$data['details'] = $this->db->query("SELECT tbl_institute_ask_a_question.*,tbl_students.student_name,tbl_students.email,tbl_students.phone FROM tbl_institute_ask_a_question LEFT JOIN tbl_students ON tbl_institute_ask_a_question.student_id = tbl_students.student_id WHERE tbl_institute_ask_a_question.type='counsellor' AND tbl_institute_ask_a_question.status='Pending'  $expert ORDER BY id DESC")->result();		
		$data['subview'] = "reports/counsellor/enquiries";		
		$this->load->view('admin/theme',$data);
	}
	
	
	public function chathistory(){
		$data['subview'] = "reports/chathistory";
		$data['chat'] = $this->db->order_by("id","desc")->group_by("student_id")->get_where("tbl_institute_student_chat_history",["institute_id"=>0])->result();
		$this->load->view('admin/theme',$data);
	}
	
	public function getChat($ssid=""){
		
		$institute_id =$this->session->userdata['institute_id'];
			
		if($ssid){
			
			$sid = $ssid;
			
		}else{
			
			$sid = $this->input->post("sid");
			
		}
		$ref = $this->input->post("ref");
		$data = $this->db->get_where("tbl_institute_student_chat_history",["institute_id"=>0,"student_id"=>$sid])->result();
		$sname = json_decode($data[0]->student_data)->student_name;

		if($ref == "view"){
		
			$chat = "";
			if(count($data) > 0){

				$chat =	'<div class="container-fluid h-100">
							<div class="row justify-content-center h-100">

								<div class="col-md-12 chat">
									<div class="card">
										<div class="card-header msg_head" style="background-color: rgb(77 86 130);">
											<div class="d-flex bd-highlight">

												<div class="user_info row" style="width:100%">
													<div class="col-md-10"><span>Chat History of '.$sname.'</span></div>
													<div class="col-md-2"><a href="javascript:void(0)" data-toggle="tooltip" class="closeChat" data-original-title="Close Chat"><span style="margin-left:50px;"><i class="fa fa-close"></i></span></a></div>	
												</div>
											</div>

										</div>
										<div class="card-body msg_card_body" style="height: 400px;border: 1px solid darkgrey;">';

											foreach($data as $row){ 

										$chat .=   '<div class="d-flex justify-content-start mb-4">

														<div class="msg_cotainer">
															'.$row->student_message.'
															<span class="msg_time">'.date("M-d h:i a",strtotime($row->created_date)).'</span>
														</div>
													</div>
													<div class="d-flex justify-content-end mb-4">
														<div class="msg_cotainer_send">
															'.$row->institute_reply.'
															<span class="msg_time_send">'.date("M-d h:i a",strtotime($row->created_date)).'</span>
														</div>

													</div>';

											 } 	

									$chat .= '</div>

									</div>
								</div>
							</div>
						</div>';

			}else{

				$chat = '<p style="font-size:18px;font-weight:500;text-align:center">No Chat Found</p>';

			}

			echo $chat;
			
		}elseif($ssid != ""){
			
			$fdata = [];
			foreach($data as $row){
				
				$ndata = [];
				$ndata["student_message"] = $row->student_message;
				$ndata["institute_reply"] = $row->institute_reply;
				$ndata["date"] = $row->created_date;
				$fdata[] = $ndata;
				
			}

			header('Content-Type: application/json');
			header('Content-Disposition: attachment; filename='.trim($sname).'.txt');
			header('Pragma: no-cache');
			echo json_encode($fdata);
			exit();
		}
		
	}
	
// chat ends	
	
	
}
