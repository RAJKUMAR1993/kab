<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');
class Calendar extends CI_Controller{
	public function __construct()
	    {
	        parent::__construct();
	        if($this->session->userdata['login_type']!='student'){redirect('student/login');}
	    }

	public function index()
	{
		
		$data['promeetings'] = $this->db->query("SELECT tbl_professor_meeting.*,tbl_professors.pro_name FROM tbl_professor_meeting LEFT JOIN tbl_professors ON tbl_professor_meeting.session_pro_id = tbl_professors.pro_id WHERE tbl_professor_meeting.session_student_id='".$this->session->userdata['student_id']."'")->result();
		$data['expertmeetings'] = $this->db->query("SELECT tbl_expert_student_schedule.*,tbl_experts.* FROM tbl_expert_student_schedule LEFT JOIN tbl_experts ON tbl_expert_student_schedule.expert_id = tbl_experts.expert_id WHERE tbl_expert_student_schedule.student_id='".$this->session->userdata['student_id']."'")->result();
		$data['speakersmeetings'] = $this->db->query("SELECT tbl_speaker_student_schedule.*,tbl_speakers.* FROM tbl_speaker_student_schedule LEFT JOIN tbl_speakers ON tbl_speaker_student_schedule.speaker_id = tbl_speakers.speaker_id WHERE tbl_speaker_student_schedule.student_id='".$this->session->userdata['student_id']."'")->result();
		$data['admmeetings'] = $this->db->query("SELECT tbl_counsellor_student_schedule.*,tbl_councellors.* FROM tbl_counsellor_student_schedule LEFT JOIN tbl_councellors ON tbl_counsellor_student_schedule.expert_id = tbl_councellors.id WHERE tbl_counsellor_student_schedule.student_id='".$this->session->userdata['student_id']."' AND tbl_councellors.is_deleted='0' AND tbl_councellors.expert_status='Active'")->result();
		$data['webinars'] = $this->db->query("SELECT tbl_webinar_participants.*,tbl_webinors.* FROM tbl_webinar_participants LEFT JOIN tbl_webinors ON tbl_webinar_participants.webinar_id = tbl_webinors.id WHERE tbl_webinar_participants.webinar_student_id='".$this->session->userdata['student_id']."'")->result();
		$data['subview'] = "calendar/calendar";
		
		$this->load->view('student/theme',$data);
	}

	
	
}
